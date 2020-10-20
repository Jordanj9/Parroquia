<?php

namespace App\Http\Controllers;

use App\Pastoral;
use App\Planpastoral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanpastoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $planes = Planpastoral::all();
        return view('pastoral.plan_pastoral.list')
            ->with('location', 'pastoral')
            ->with('planes', $planes);
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
                $pastorales[$item->id] = "PASTORAL " . $item->nombre . " - PARROQUIA: " . $item->parroquia->nombre;
            }
        }
        $array = null;
        $array = collect($array);
        DB::table('administracions')->orderBy('id')->chunk(100, function ($admins) use ($array) {
            foreach ($admins as $admin) {
                $array[$admin->id] = $admin->fecha_inicio . " - " . $admin->fecha_fin . " ESTADO: " . $admin->estado;
            }
        });
        return view('pastoral.plan_pastoral.create')
            ->with('location', 'pastoral')
            ->with('pastorales', count($datos) > 0 ? $pastorales : $datos)
            ->with('admins', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $plan = new Planpastoral($request->all());
        $plan->descripcion = isset($request->descripcion) ? strtoupper($request->descripcion) : null;
        $hoy = getdate();
        $file = $request->file("nombre");
        $name = "Plan_" . $hoy["year"] . $hoy["mon"] . $hoy["mday"] . $hoy["hours"] . $hoy["minutes"] . $hoy["seconds"] . "_" . $file->GetClientOriginalName();
        $path = public_path() . "/docs/planes/";
        $file->move($path, $name);
        $plan->archivo = $name;
        $result = $plan->save();
        if ($result) {
            flash("El plan para la pastoral <strong>" . $plan->pastoral->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('planpastoral.index');
        } else {
            flash("El plan para la pastoral <strong>" . $plan->pastoral->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('planpastoral.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Planpastoral $planpastoral
     * @return \Illuminate\Http\Response
     */
    public function show(Planpastoral $planpastoral) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Planpastoral $planpastoral
     * @return \Illuminate\Http\Response
     */
    public function edit(Planpastoral $planpastoral) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Planpastoral $planpastoral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planpastoral $planpastoral) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Planpastoral $planpastoral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $plan = Planpastoral::find($id);
        $result = $plan->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "El plan pastoral fue elimidao de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "El plan pastoral no pudo ser eliminado. Error: " . $result
            ]);
        }
    }
}
