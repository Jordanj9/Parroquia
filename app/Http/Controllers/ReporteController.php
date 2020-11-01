<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Miembro;
use App\Pastoral;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteController extends Controller
{

    public function ViewMiembroPastoral()
    {
        $eventos = null;
        collect($eventos);
        $pastorales = Pastoral::all()->pluck('nombre', 'id');
        return view('reportes.miembro_por_pastoral')
            ->with('location', 'reportes')
            ->with('pastorales', $pastorales);
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
                if ($desde != 'null' && $hasta != 'null')
                    $obj = $comunidad->miembrocomunidads()->whereBetween('created_at', [$desde, $hasta])->get();
                if ($desde == 'null' and $hasta == 'null')
                    $obj = $comunidad->miembrocomunidads;
                if ($desde == 'null' and $hasta != 'null')
                    $obj = $comunidad->miembrocomunidads()->whereDate('created_at', '<=', $hasta)->get();
                if ($desde != 'null' and $hasta == 'null')
                    $obj = $comunidad->miembrocomunidads()->whereDate('created_at', '>=', $hasta)->get();
                if (count($obj) > 0) {
                    foreach ($obj as $item) {
                        $miembro = $item->miembro;
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
                        $per['pastoral'] = $comunidad->pastoral->nombre;
                        $response[] = $per;
                    }
                }
            }
        }
        if (count($response) > 0) {
            if ($pdf == 'true') {
                return $this->imprimir($response, $pastoral, $desde, $hasta);
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

    public function imprimir($response, $pastoral, $inicio, $final)
    {
        $arror = $this->orderMultiDimensionalArray($response, 'nom', false);
        $encabezado = null;
        $hoy = getdate();
        $cabeceras = ['Nombre', 'Dirección', 'Telefono', 'Sexo', 'Edad', 'Pastoral'];
        $filtros = [
            'PASTORAL' => $pastoral,
            'DESDE' => $inicio == 'null' ? '--' : $inicio,
            'HASTA' => $final == 'null' ? $hoy["mday"] . "/" . $hoy["mon"] . "/" . $hoy["year"] : $final,
        ];
        $fechar = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
        $date['fecha'] = $fechar;
        $date['encabezado'] = $encabezado;
        $date['cabeceras'] = $cabeceras;
        $date['data'] = $arror;
        $date['nivel'] = 1;
        $date['titulo'] = "REPORTES DE MIEMBROS - LISTADO DE MIEMBROS POR PASTORAL";
        $date['filtros'] = $filtros;
        //$pdf = Pdf::loadView('reportes.print_1_2_niveles', $date);
        //composer require barryvdh/laravel-dompdf
//        $path = public_path() . "/docs/reportes/";
//        $name = 'Reporte_'. $hoy["year"] . $hoy["mon"] . $hoy["mday"] . $hoy["hours"] . $hoy["minutes"] . $hoy["seconds"].'.pdf';
        $pdf = PDF::loadView('reportes.PDF.print_1_2_niveles', $date);
//            ->save($path.$name);
        return $pdf->stream('Miembrosporpatoral.pdf');
    }

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
