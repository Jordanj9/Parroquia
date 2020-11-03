<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Miembro;
use App\Miembrocomunidad;
use App\ocupacion;
use App\Pastoral;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function ViewMiembroPastoral()
    {
        $pastorales = Pastoral::all()->pluck('nombre', 'id');
        return view('reportes.miembro_por_pastoral')
            ->with('location', 'reportes')
            ->with('pastorales', $pastorales);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function ViewMiembroComunidad()
    {
        $datos = Pastoral::all()->sortBy('nombre');
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        return view('reportes.miembro_por_cominidad')
            ->with('location', 'reportes')
            ->with('realidades', count($datos) > 0 ? $pastorales : $datos);
    }

    public function ViewMiembroOcupacion()
    {
        $ocupaciones = ocupacion::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('reportes.miembro_por_ocupacion')
            ->with('location', 'reportes')
            ->with('ocupaciones', $ocupaciones);
    }

    public function ViewMiembroGet()
    {
        return view('reportes.miembro_buscar')
            ->with('location', 'reportes');
    }

    public function buscarMiembro($nombre)
    {
        $string = strtoupper($nombre);
        $miembros = Miembro::where('nombres', 'like', "%" . $string . "%")->orWhere('apellidos', 'like', "%" . $string . "%")->get();
        $response = [];
        if (count($miembros) > 0) {
            foreach ($miembros as $item) {
                $per = $this->llenarMiembro($item);
                $per['identificacion'] = $item->tipo_documento . " - " . $item->identificacion;
                $per['id'] = $item->id;
                $response[] = $per;
            }
        }
        if (count($response) > 0) {
            return response()->json([
                'response' => $response,
                'status' => 'ok'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }

    }

    /**
     * Obtine todos los miebros de una pastoral
     * @param $pastoral_id
     * @param $desde
     * @param $hasta
     * @return JsonResponse
     */
    public function miembrosPastoral($pastoral_id, $desde, $hasta, $pdf)
    {

        if ($pastoral_id == 'TODO') {
            $pastoral = 'TODO';
            $comunidades = Comunidad::all();
        } else {
            $pastoral = Pastoral::find($pastoral_id);
            $comunidades = $pastoral->comunidads;
            $pastoral = $pastoral->nombre;
        }
        $response = [];
        if (count($comunidades) > 0) {
            foreach ($comunidades as $comunidad) {
                $obj = $this->getMiembroscomunidads($comunidad, $desde, $hasta);
                if (count($obj) > 0) {
                    foreach ($obj as $item) {
                        $per = $this->llenarMiembro($item->miembro);
                        $per['pastoral'] = $item->comunidad->pastoral->nombre;
                        $per['anio'] = $item->anio_ingreso;
                        $response[] = $per;
                    }
                }
            }
        }
        if (count($response) > 0) {
            if ($pdf == 'true') {
                $hoy = getdate();
                $encabezado = null;
                $cabeceras = ['Nombre', 'Dirección', 'Telefono', 'Sexo', 'Edad', 'Pastoral', 'Año de Ingreso'];
                $filtros = [
                    'PASTORAL' => $pastoral,
                    'DESDE' => $desde == 'null' ? '--' : $desde,
                    'HASTA' => $hasta == 'null' ? $hoy["mday"] . "/" . $hoy["mon"] . "/" . $hoy["year"] : $hasta,
                ];
                $titulo = "REPORTES DE MIEMBROS - LISTADO DE MIEMBROS POR PASTORAL";
                $array = $this->orderMultiDimensionalArray($response, 'nom', false);
                $nombre = "Miembrosporcuminidad.pdf";
                return $this->imprimir($array, $cabeceras, $filtros, $titulo, $nombre);
            } else {
                return datatables()->collection($response)->toJson();
            }
        }
        return datatables()->collection($response)->toJson();

//        if (count($response) > 0) {
//            return datatables()->collection($response)->toJson();
//        } else {
//            return datatables()->collection($response)->toJson();
////            return response()->json([
////                'status' => 'error'
////            ]);
//        }
    }

    /**
     * @param $comunidad_id
     * @param $desde
     * @param $hasta
     * @param $pdf
     * @return JsonResponse
     */
    public function miembrosComunidad($comunidad_id, $desde, $hasta, $pdf)
    {
        $comunidad = Comunidad::find($comunidad_id);
        $object = $this->getMiembroscomunidads($comunidad, $desde, $hasta);
        $response = [];
        if (count($object) > 0) {
            foreach ($object as $item) {
                $per = $this->llenarMiembro($item->miembro);
                $per['pastoral'] = $item->comunidad->pastoral->nombre;
                $per['anio'] = $item->anio_ingreso;
                $response[] = $per;
            }
        }
        if (count($response) > 0) {
            if ($pdf == 'true') {
                $hoy = getdate();
                $encabezado = null;
                $cabeceras = ['Nombre', 'Dirección', 'Telefono', 'Sexo', 'Edad', 'Pastoral', 'Año de Ingreso'];
                $filtros = [
                    'PASTORAL' => $comunidad->pastoral->nombre,
                    'SUBPASTORAL' => $comunidad->subpastoral_id != null ? $comunidad->subpastoral->nombre : '--',
                    'COMUNIDAD' => "N°." . $comunidad->numero . " - DÍA Y HORA DE REUNIÓN: " . $comunidad->dia . " - " . $comunidad->hora,
                    'DESDE' => $desde == 'null' ? '--' : $desde,
                    'HASTA' => $hasta == 'null' ? $hoy["mday"] . "/" . $hoy["mon"] . "/" . $hoy["year"] : $hasta,
                ];
                $titulo = "REPORTES DE MIEMBROS - LISTADO DE MIEMBROS POR COMUNIDAD";
                $nombre = "Miembrosporcuminidad.pdf";
                $array = $this->orderMultiDimensionalArray($response, 'nom', false);
                return $this->imprimir($array, $cabeceras, $filtros, $titulo, $nombre);
            } else {
                return datatables()->collection($response)->toJson();
            }
        }
        return datatables()->collection($response)->toJson();
    }

    public function miembrosOcupacion($ocupacion_id, $pdf)
    {
        $ocupacion = ocupacion::find($ocupacion_id);
        $miembros = $ocupacion->miembros;
        $response = [];
        if (count($miembros) > 0) {
            foreach ($miembros as $item) {
                $per = $this->llenarMiembro($item);
                $per['ocupacion'] = $item->ocupacion->nombre;
                $response[] = $per;
            }
        }
        if (count($response) > 0) {
            if ($pdf == 'true') {
                $cabeceras = ['Nombre', 'Dirección', 'Telefono', 'Sexo', 'Edad', 'Ocupación'];
                $filtros = ['OCUPACIÓN' => $ocupacion->nombre];
                $titulo = "REPORTES DE MIEMBROS - LISTADO DE MIEMBROS POR OCUPACIÓN";
                $nombre = "Miembrosporocupacion.pdf";
                $array = $this->orderMultiDimensionalArray($response, 'nom', false);
                return $this->imprimir($array, $cabeceras, $filtros, $titulo, $nombre);
            } else {
                return datatables()->collection($response)->toJson();
            }
        }
        return datatables()->collection($response)->toJson();
    }

    /**
     * @param Comunidad $comunidad
     * @param $desde
     * @param $hasta
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getMiembroscomunidads(Comunidad $comunidad, $desde, $hasta)
    {

        if ($desde != 'null' && $hasta != 'null')
            $obj = $comunidad->miembrocomunidads()->whereBetween('created_at', [$desde, $hasta])->get();
        if ($desde == 'null' and $hasta == 'null')
            $obj = $comunidad->miembrocomunidads;
        if ($desde == 'null' and $hasta != 'null')
            $obj = $comunidad->miembrocomunidads()->whereDate('created_at', '<=', $hasta)->get();
        if ($desde != 'null' and $hasta == 'null')
            $obj = $comunidad->miembrocomunidads()->whereDate('created_at', '>=', $hasta)->get();

        return $obj;
    }

    /**
     * @param $item
     * @param false $aux
     * @return mixed
     */
    public function llenarMiembro($miembro)
    {
        //foreach ($array as $item) {
        // $miembro = $item->miembro;
        $per['nom'] = $miembro->nombres . " " . $miembro->apellidos;
        $per['dir'] = $miembro->direccion . " " . $miembro->barrio;
        $per['tel'] = $miembro->telefono . " - " . $miembro->celular;
        $per['sexo'] = $miembro->sexo;
        if ($miembro->edad == null) {
            $hoy = date("Y-m-d");
            $per['edad'] = date_diff(date_create($miembro->fechanacimiento), date_create($hoy))->y;
        } else {
            $per['edad'] = $miembro->edad;
        }
        return $per;
    }

    /**
     * @param $response
     * @param $cabeceras
     * @param $filtros
     * @param $titulo
     * @param $nombre
     * @param null $encabezado
     * @return mixed
     */
    public function imprimir($response, $cabeceras, $filtros, $titulo, $nombre, $encabezado = null)
    {
//        $arror = $this->orderMultiDimensionalArray($response, 'nom', false);
//        $encabezado = $encabezadop;
        $hoy = getdate();
//        $cabeceras = $cabecerasp;
//        $filtros = $filtrosp;
        $fechar = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        $date['fecha'] = $fechar;
        $date['encabezado'] = $encabezado;
        $date['cabeceras'] = $cabeceras;
        $date['data'] = $response;
        $date['nivel'] = 1;
        $date['titulo'] = $titulo;
        $date['filtros'] = $filtros;
        //$pdf = Pdf::loadView('reportes.print_1_2_niveles', $date);
        //composer require barryvdh/laravel-dompdf
//        $path = public_path() . "/docs/reportes/";
//        $name = 'Reporte_'. $hoy["year"] . $hoy["mon"] . $hoy["mday"] . $hoy["hours"] . $hoy["minutes"] . $hoy["seconds"].'.pdf';
        $pdf = PDF::loadView('reportes.PDF.print_1_2_niveles', $date);
//            ->save($path.$name);
        return $pdf->stream($nombre);
    }

    /**
     * @param $toOrderArray
     * @param $field
     * @param false $inverse
     * @return array
     */
    function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false)
    {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }
}
