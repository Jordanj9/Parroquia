<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Estadocivil;
use App\Miembro;
use App\Miembrocomunidad;
use App\Miembropastoral;
use App\Miembrosacramento;
use App\Miembrosituacion;
use App\ocupacion;
use App\Pastoral;
use App\Sacramento;
use App\Situacionespiritual;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miembros = Miembro::all();
        $hoy = date("Y-m-d");
        if (count($miembros) > 0) {
            foreach ($miembros as $item) {
                $edad = ($item->fechanacimiento != null) ? date_diff(date_create($item->fechanacimiento), date_create($hoy))->y : null;
                $item->edad = $item->edad == null ? $edad : $item->edad;
            }
        }
        return view('pastoral.miembros.list')
            ->with('location', 'pastoral')
            ->with('miembros', $miembros);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $datos = Pastoral::all()->sortBy('nombre');
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        $comunidades = Comunidad::all()->sortBy('numero');
        if (count($comunidades) > 0) {
            foreach ($comunidades as $item) {
                $string = "COMUNIDAD: N°." . $item->numero;
                $comu[$item->id] = $item->subpastoral_id != null ? $string . " - SUBPASTORAL: " . $item->subpastoral->nombre : $string . " - PASTORAL: " . $item->pastoral->nombre;
            }
        }
        $ocupaciones = ocupacion::all()->sortBy('nombre')->pluck('nombre', 'id');
        $estados = Estadocivil::all()->sortBy('nombre')->pluck('nombre', 'id');
        $situaciones = Situacionespiritual::all()->sortBy('nombre')->pluck('nombre', 'id');
        $sacramentos = Sacramento::all()->sortBy('nombre')->pluck('nombre', 'id');
        //dd($pastorales);
        $hoy = getdate();
        return view('pastoral.miembros.create')
            ->with('location', 'pastoral')
            ->with('realidades', count($datos) > 0 ? $pastorales : $datos)
            ->with('comunidades', count($comunidades) > 0 ? $comu : $comunidades)
            ->with('ocupaciones', $ocupaciones)
            ->with('situaciones', $situaciones)
            ->with('sacramentos', $sacramentos)
            ->with('anio', $hoy['year'])
            ->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse;
     */
    public function store(Request $request)
    {
        $values = array();
        parse_str($request->form, $values);
        $miembro = Miembro::where('identificacion', $values['identificacion'])->first();
        foreach ($values as $key => $value) {
            if (isset($values[$key]) && $values[$key] == '') {
                $values[$key] = null;
            }
        }
        if ($miembro == null) {
            $miembro = new Miembro($values);
        } else {
            foreach ($miembro->attributesToArray() as $key => $value) {
                if (isset($values[$key]) && $values[$key] != '') {
                    $miembro->$key = strtoupper($values[$key]);
                }
            }
        }
        $miembro->acueducto = isset($values['acueducto']) ? 'SI' : 'NO';
        $miembro->alcantarillado = isset($values['alcantarillado']) ? 'SI' : 'NO';
        $miembro->luz = isset($values['luz']) ? 'SI' : 'NO';
        $miembro->tel = isset($values['tel']) ? 'SI' : 'NO';
        $miembro->sanitario = isset($values['sanitario']) ? 'SI' : 'NO';
        $miembro->letrina = isset($values['letrina']) ? 'SI' : 'NO';
        $miembro->gas = isset($values['gas']) ? 'SI' : 'NO';
        $miembro->acueducto = isset($values['acueducto']) ? 'SI' : 'NO';
        $miembro->trabaja = isset($values['trabaja']) ? 'SI' : 'NO';
//        if ($values['nombre_padres_paternos'] != null)
//            $miembro->nombre_padres_paternos = $values['nombre_papa'];
//        if ($values['nombre_padres_maternos'] != null)
//            $miembro->nombre_padres_maternos = $value['nombre_mama'];
        foreach ($miembro->attributesToArray() as $key => $value) {
            if ($miembro->$key != null) {
                $miembro->$key = strtoupper($value);
            }
        }
//        $miembro->fechanacimiento = (isset($values['fechanacimiento']) && $values['fechanacimiento'] != '') ? $values['fechanacimiento']:null;
//        $miembro->fecha_matrimonio = (isset($values['fecha_matrimonio']) && $values['fecha_matrimonio'] != '') ? $values['fecha_matrimonio']:null;
//        $miembro->fecha_anulacion_matrimonio = (isset($values['fecha_anulacion_matrimonio']) && $values['fecha_anulacion_matrimonio'] != '') ? $values['fecha_anulacion_matrimonio']:null;
        if (isset($values['comunidadesp']) && count($values['comunidadesp']) > 0) {
            $array = null;
            foreach ($values['comunidadesp'] as $com) {
                $item = Comunidad::find($com);
                $string = "COMUNIDAD: " . $item->numero . " DÍA - HORA: " . $item->dia . " - " . $item->hora;
                $obj[$item->id] = $item->subpastoral_id != null ? $string . " SUBPASTORAL: " . $item->subpastoral->nombre : $string . " PASTORAL: " . $item->pastoral->nombre;
                $array[] = $obj;
            }
            $miembro->comunidades = json_encode($array);
        } else {
            $miembro->comunidades = null;
        }
        $result = $miembro->save();
        if ($result) {
            $miem_comu = new Miembrocomunidad($values);
            $miem_comu->fecha_censo_salud = (isset($values['fecha_censo_salud']) && $values['fecha_censo_salud'] != '') ? $values['fecha_censo_salud'] : null;
            $miem_comu->miembro_id = $miembro->id;
            $result2 = $miem_comu->save();
            if ($result2) {
                if (isset($request->dispo) && count($request->dispo) > 0) {
                    foreach ($request->dispo as $item) {
                        $exis = Miembrosacramento::where([['sacramento_id', $item['sacramento_id']], ['miembro_id', $miembro->id]])->first();
                        if ($exis == null) {
                            $miem_sacra = new Miembrosacramento();
                            $miem_sacra->sacramento_id = $item['sacramento_id'];
                            $miem_sacra->miembro_id = $miembro->id;
                            $miem_sacra->lugar = strtoupper($item['lugar']);
                            $miem_sacra->save();
                        }
                    }
                }
                if (isset($values['situaciones']) && count($values['situaciones']) > 0) {
                    foreach ($values['situaciones'] as $item) {
                        $exis = Miembrosituacion::where([['situacionespiritual_id', $item], ['miembro_id', $miembro->id]])->first();
                        if ($exis == null) {
                            $miem_situ = new Miembrosituacion();
                            $miem_situ->situacionespiritual_id = $item;
                            $miem_situ->miembro_id = $miembro->id;
                            $miem_situ->save();
                        }
                    }
                }
                if (isset($values['realidades']) && count($values['realidades']) > 0) {
                    foreach ($values['realidades'] as $item) {
                        $exis = Miembropastoral::where([['pastoral_id', $item], ['miembro_id', $miembro->id]])->first();
                        if ($exis == null) {
                            $miem_real = new Miembropastoral();
                            $miem_real->pastoral_id = $item;
                            $miem_real->miembro_id = $miembro->id;
                            $miem_real->save();
                        }
                    }
                }
                return response()->json([
                    'status' => 'ok',
                    'message' => "El miembro <strong>" . $miembro->nombres . "</strong> fue agregado de forma exitosa!"
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "El miembro <strong>" . $miembro->nombres . "</strong> no pudo ser agregado. Error: " . $result2
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "El miembro <strong>" . $miembro->nombres . "</strong> no pudo ser agregado. Error: " . $result
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\View\View
     */
    public function show(Miembro $miembro)
    {
        return view('pastoral.miembros.show')
            ->with('location','pastoral')
            ->with('miembro',$miembro)
            ->with('comunidades',$miembro->comunidades != null ? json_decode($miembro->comunidades):null);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function edit(Miembro $miembro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Miembro $miembro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Miembro $miembro)
    {
        //
    }

    /**
     * Get the specified miembro from identificacion
     *
     * @param $tipo_doc
     * @param $identificacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMiembro($tipo_doc, $identificacion)
    {
        $miembro = Miembro::where([['tipo_documento', $tipo_doc], ['identificacion', $identificacion]])->first();
        if ($miembro != null) {
            $miembro->sacramentos = $miembro->miembrosacramentos;
            $miembro->realidades = $miembro->miembropastorals;
            $miembro->comunidadesp = $miembro->miembrocomunidads;
            return response()->json([
                'response' => $miembro,
                'status' => 'ok'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
