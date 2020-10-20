<?php

namespace App\Http\Controllers;

use App\Consejo;
use App\Lider;
use App\Miembro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsejopastoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $consejos = Consejo::where('tipo', 'PASTORAL')->get();
        if (count($consejos) > 0) {
            foreach ($consejos as $item) {
                if ($item->lider_id != null) {
                    $item->identificacion = $item->lider->identificacion;
                    $item->nombre = $item->lider->nombre;
                } else {
                    $item->identificacion = $item->miembro->identificacion;
                    $item->nombre = $item->miembro->nombres . " " . $item->miembro->apellidos;
                }
            }
        }
        return view('administracion.consejo_pastoral.list')
            ->with('location', 'administracion')
            ->with('consejos', $consejos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $array = null;
        $array = collect($array);
        DB::table('administracions')->orderBy('id')->chunk(100, function ($admins) use ($array) {
            foreach ($admins as $admin) {
                $array[$admin->id] = $admin->fecha_inicio . " - " . $admin->fecha_fin . " ESTADO: " . $admin->estado;
            }
        });
        $lideres = Lider::all();
        $miembros = Miembro::all();
        $datos = collect();
        if (count($lideres) > 0) {
            foreach ($lideres as $item) {
                $datos[$item->id . "-L"] = $item->identificacion . " - " . $item->nombre;
            }
        }
        if (count($miembros) > 0) {
            foreach ($miembros as $item) {
                $datos[$item->id . "-M"] = $item->identificacion . " - " . $item->nombres . " " . $item->apellidos;
            }
        }
        return view('administracion.consejo_pastoral.create')
            ->with('location', 'administracion')
            ->with('personas', $datos)
            ->with('admins', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $response = null;
        foreach ($request->personas as $item) {
            $aux = explode('-', $item);
            $consejo = new Consejo();
            $consejo->tipo = 'PASTORAL';
            $consejo->administracion_id = $request->administracion_id;
            if ($aux[1] == 'L') {
                $consejo->lider_id = $aux[0];
            } else {
                $consejo->miembro_id = $aux[0];
            }
            if ($consejo->save()) {
                $string = $aux[1] == 'L' ? $consejo->lider->identificacion . " - " . $consejo->lider->nombre : $consejo->miembro->identificacion . " - " . $consejo->miembro->nombres . " " . $consejo->miembro->apellidos;
                $response = $response . "<p>" . $string . " almacenado correctamente <i class='material-icons'>check_circle</i></p>";
            } else {
                $string = $aux[1] == 'L' ? $consejo->lider->identificacion . " - " . $consejo->lider->nombre : $consejo->miembro->identificacion . " - " . $consejo->miembro->nombres . " " . $consejo->miembro->apellidos;
                $response = $response . "<p>" . $string . " no pudo ser almacenado correctamente <i class='material-icons'>error</i></p>";
            }
        }
        flash($response)->success();
        return redirect()->route('consejopastoral.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $consejo = Consejo::find($id);
        $result = $consejo->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "La Persona fue retirada de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "La Persona no pudo ser retirada. Error: " . $result
            ]);
        }
    }
}
