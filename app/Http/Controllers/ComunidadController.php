<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Comunidadlider;
use App\Lider;
use App\Pastoral;
use App\Subpastoral;
use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $comunidades = Comunidad::all()->sortByDesc('id');
        return view('pastoral.comunidad.list')
            ->with('location', 'pastoral')
            ->with('comunidades', $comunidades);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $datos = Pastoral::all()->sortBy('nombre');
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        $horas = ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
        return view('pastoral.comunidad.create')
            ->with('location', 'pastoral')
            ->with('horas', $horas)
            ->with('pastorales', count($datos) > 0 ? $pastorales : $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        if (isset($request->subpastoral_id)) {
            $existe = Comunidad::where([['numero', $request->numero], ['subpastoral_id', $request->subpastoral_id]])->first();
            $tip = 'Subpastoral';
        } else {
            $existe = Comunidad::where([['numero', $request->numero], ['pastoral_id', $request->pastoral_id]])->first();
            $tip = 'Pastoral';
        }
        if ($existe != null) {
            flash("Atención!. Ya existe la comunidad N° <strong>" . $request->numero . "</strong> para la " . $tip . " seleccionada.")->warning();
            return redirect()->route("comunidad.index");
        }
        $comunidad = new Comunidad($request->all());
        foreach ($comunidad->attributesToArray() as $key => $value) {
            $comunidad->$key = strtoupper($value);
        }
        $result = $comunidad->save();
        if ($result) {
            $response = null;
            if ($request->catequistas != null) {
                $catequistas = explode(',', $request->catequistas);
                $response = $this->comunidadlider($catequistas, 'Catequista', $response, $comunidad->id);
            }
            if ($request->animadores != null) {
                $animadores = explode(',', $request->animadores);
                $response = $this->comunidadlider($animadores, 'Animador', $response, $comunidad->id);
            }
            if ($request->servidores != null) {
                $servidores = explode(',', $request->servidores);
                $response = $this->comunidadlider($servidores, 'Servidor', $response, $comunidad->id);
            }
            if ($request->asesores != null) {
                $asesores = explode(',', $request->asesores);
                $response = $this->comunidadlider($asesores, 'Asesor', $response, $comunidad->id);
            }
            if ($request->lideres != null) {
                $lideres = explode(',', $request->lideres);
                $response = $this->comunidadlider($lideres, 'Lider', $response, $comunidad->id);
            }
            if ($request->responsables != null) {
                $responsables = explode(',', $request->responsable);
                $response = $this->comunidadlider($responsables, 'Responsable', $response, $comunidad->id);
            }
            if ($response != null) {
                flash($response)->success();
                return redirect()->route("comunidad.index");
            }
        } else {
            flash("La Comunidad ingresada no pudo ser almacenada de forma correcta por favor intentelo mas tarde. Error: " . $result)->warning();
            return redirect()->route("comunidad.index");
        }
    }

    /**
     * llena las tablas liders y comunidadlider
     *
     * @return string
     */
    public function comunidadlider($array, $tipo, $response, $comunidad_id) {
        foreach ($array as $item) {
            if (mb_stristr($item, "-") == true) {
                $aux = explode('-', $item);
                $lider = Lider::where('identificacion', $aux[0])->first();
                $ban = $result = false;
                if ($lider == null) {
                    $lider = new Lider();
                    $lider->identificacion = $aux[0];
                    $lider->nombre = strtoupper($aux[1]);
                    $result = $lider->save();
                } else {
                    $ban = true;
                }
                if ($result == true || $ban == true) {
                    $comunidadlier = new Comunidadlider();
                    $comunidadlier->tipo = strtoupper($tipo);
                    $comunidadlier->comunidad_id = $comunidad_id;
                    $comunidadlier->lider_id = $lider->id;
                    if ($comunidadlier->save()) {
                        $response = $response . "<p>" . $tipo . " " . $lider->identificacion . " " . $lider->nombre . " almacenado correctamente <i class='material-icons'>check_circle</i></p>";
                    } else {
                        $response = $response . "<p>" . $tipo . " " . $lider->identificacion . " " . $lider->nombre . " no pudo ser almacenado <i class='material-icons'>error</i></p>";
                    }
                } else {
                    $response = $response . "<p>" . $tipo . " " . $lider->identificacion . " " . $lider->nombre . " no pudo ser almacenado <i class='material-icons'>error</i></p>";
                }
            } else {
                $response = $response . "<p> Atención! Formato incorrecto para" . $item . " debe ingresar a las personas con el número de identificaion seguido del signo '-' y luego el nombre. <i class='material-icons'>warning</i></p>";
            }
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Comunidad $comunidad
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $comunidad = Comunidad::find($id);
        $arrays = $comunidad->comunidadliders->groupBy('tipo');
        return view('pastoral.comunidad.show')
            ->with('location', 'pastoral')
            ->with('array', $arrays)
            ->with('comunidad', $comunidad);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Comunidad $comunidad
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $comunidad = Comunidad::find($id);
        $datos = Pastoral::all()->sortBy('nombre');
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        $horas = ['6:00', '7:00', '8:00', '9:00', '10:00', '11:00', '12:00',
            '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'];
        $dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'];
        $arrays = $comunidad->comunidadliders->groupBy('tipo');
        // $array=$comunidad->comunidadliders;
//        $catequistas = $animadores = $servidores = $asesores = $lideres = $responsables = null;
//        if (count($array) > 0) {
//            foreach ($array as $item) {
//                switch ($item->tipo) {
//                    case "CATEQUISTA":
//                        $catequistas = $catequistas . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    case "ANIMADOR":
//                        $animadores = $animadores . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    case "SERVIDOR":
//                        $servidores = $servidores . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    case "ASESOR":
//                        $asesores = $asesores . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    case "LIDER":
//                        $lideres = $lideres . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    case "RESPONSABLE":
//                        $responsables = $responsables . $item->lider->identificacion . "-" . $item->lider->nombre . ",";
//                        break;
//                    default:
//                        break;
//                }
//            }
//        }
        //dd($response);
        return view('pastoral.comunidad.edit')
            ->with('location', 'pastoral')
            ->with('comunidad', $comunidad)
            ->with('horas', $horas)
            ->with('dias', $dias)
            ->with('array', $arrays)
//            ->with('catequistas', $catequistas)->with('animadores', $animadores)->with('servidores', $servidores)
//            ->with('asesores', $asesores)->with('lideres', $lideres)->with('responsables', $responsables)
            ->with('pastorales', count($datos) > 0 ? $pastorales : $datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Comunidad $comunidad
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $comunidad = Comunidad::find($id);
        if ($comunidad->subpastoral_id != null) {
            $existe = Comunidad::where([['numero', $request->numero], ['subpastoral_id', $comunidad->subpastoral_id]])->first();
            $tip = 'Subpastoral';
        } else {
            $existe = Comunidad::where([['numero', $request->numero], ['pastoral_id', $comunidad->pastoral_id]])->first();
            $tip = 'Pastoral';
        }
        if ($existe != null && $comunidad->id != $existe->id) {
            flash("Atención!. Ya existe la comunidad N° <strong>" . $request->numero . "</strong> para la " . $tip . " seleccionada.")->warning();
            return redirect()->route("comunidad.edit", $id);
        }
        foreach ($comunidad->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $comunidad->$key = strtoupper($request->$key);
            }
        }
        $result = $comunidad->id;
        if ($result) {
            flash("La Comunidad <strong>" . $comunidad->numero . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('comunidad.index');
        } else {
            flash("La Comunidad <strong>" . $comunidad->numero . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('comunidad.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Comunidad $comunidad
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $comunidad = Comunidad::find($id);
        if (count($comunidad->comunidadliders) > 0) {
            return response()->json([
                'status' => 'warning',
                'message' => "La Comunidad <strong>" . $comunidad->nombre . "</strong> no pudo ser eliminada porque tiene lideres asociados."
            ]);
        }
        $result = $comunidad->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "La Comunidad <strong>" . $comunidad->nombre . "</strong> fue eliminada de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "La Comunidad <strong>" . $comunidad->nombre . "</strong> no pudo ser eliminada. Error: " . $result
            ]);
        }
    }

    /**
     * Remove the specified resource from storage in comunidadliders table
     *
     * @param \App\Comunidadlider $id
     * @returns \Illuminate\Http\JsonResponse
     */
    public function quitarLider($id) {
        $comlid = Comunidadlider::find($id);
        $result = $comlid->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "La Persona <strong>" . $comlid->lider->nombre . "</strong> fue retirado de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "La Persona <strong>" . $comlid->lider->nombre . "</strong> no pudo ser retirado. Error: " . $result
            ]);
        }
    }

    /**
     * Almacena un lider in lider table and comunidadliders table
     *
     * @param \App\Comunidad $id
     * @param string $tipo
     * @param string $nombre
     * @param string $ident
     * @returns \Illuminate\Http\JsonResponse
     */
    public function guardarLider($id, string $tipo, string $nombre, string $ident) {
        $com = Comunidad::find($id);
        $lider = Lider::where('identificacion', $ident)->first();
        $ban = $result = false;
        if ($lider == null) {
            $lider = new Lider();
            $lider->identificacion = $ident;
            $lider->nombre = strtoupper($nombre);
            $result = $lider->save();
        } else {
            $ban = true;
        }
        if ($result == true || $ban == true) {
            $comunidadlier = new Comunidadlider();
            $comunidadlier->tipo = $tipo;
            $comunidadlier->comunidad_id = $com->id;
            $comunidadlier->lider_id = $lider->id;
            $result2 = $comunidadlier->save();
            if ($result2) {
                return response()->json([
                    'status' => 'ok',
                    'message' => "La Persona <strong>" . $comunidadlier->lider->nombre . "</strong> fue agregado de forma exitosa!"
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "La Persona <strong>" . $comunidadlier->lider->nombre . "</strong> no pudo ser agragado. Error: " . $result2
                ]);
            }
        }
    }

    /**
     * Obtiene todas las subpastorales de una pastoral
     *
     * @param \App\Pastoral $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubpastorales($id) {
        $pastoral = Pastoral::find($id);
        if (count($pastoral->subpastorals) > 0) {
            $response = null;
            foreach ($pastoral->subpastorals as $item) {
                $obj['id'] = $item->id;
                $obj['value'] = $item->nombre;
                $response[] = $obj;
            }
            return json_encode($response);
        } else {
            return 'null';
        }
    }

    /**
     * Obtines las comunidades de una pastoral o subpastoral
     *
     * @param \App\Pastoral $pastoral
     * @param \App\Subpastoral $subpastoral
     * @return \Illuminate\Http\JsonResponse
     */
    public function getComunidades($id, $value) {
        if ($value == 'PASTORAL') {
            $modelo = Pastoral::find($id);
        } else {
            $modelo = Subpastoral::find($id);
        }
        if (count($modelo->comunidads) > 0) {
            $response = null;
            foreach ($modelo->comunidads as $item) {
                $obj['id'] = $item->id;
                $obj['value'] = "COMUNIDAD: N°." . $item->numero . " - DÍA Y HORA DE REUNIÓN: " . $item->dia . " - " . $item->hora;
                $response[] = $obj;
            }
            return json_encode($response);
        } else {
            return 'null';
        }
    }
}
