<?php

namespace App\Http\Controllers;

use App\Administracion;
use App\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $empleados = Empleado::all();
        return view('administracion.empleados.list')
            ->with('location', 'administracion')
            ->with('empleados', $empleados);
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
        return view('administracion.empleados.create')
            ->with('location', 'administracion')
            ->with('admins', $array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $existe = Empleado::where('identificacion', $request->identificacion)->first();
        if ($existe != null) {
            flash("Atención!. Ya existe un empleado con la identificaión ingresada.")->warning();
            return redirect()->route('empleado.create');
        }
        $empleado = new Empleado($request->all());
        foreach ($empleado->attributesToArray() as $key => $value) {
            if ($key === 'correo') {
                $empleado->$key = $value;
            } else {
                $empleado->$key = strtoupper($value);
            }
        }
        $result = $empleado->save();
        if ($result) {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('empleado.index');
        } else {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('empleado.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $empleado = Empleado::find($id);
        return view('administracion.empleados.show')
            ->with('location', 'administracion')
            ->with('empleado', $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $array = null;
        $array = collect($array);
        DB::table('administracions')->orderBy('id')->chunk(100, function ($admins) use ($array) {
            foreach ($admins as $admin) {
                $array[$admin->id] = $admin->fecha_inicio . " - " . $admin->fecha_fin . " ESTADO: " . $admin->estado;
            }
        });
        $empleado = Empleado::find($id);
        return view('administracion.empleados.edit')
            ->with('location', 'administracion')
            ->with('empleado', $empleado)
            ->with('admins', $array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $existe = Empleado::where('identificacion', $request->identificacion)->first();
        if ($existe != null && $existe->id != $id) {
            flash("Atención!. Ya existe un empleado con la identificaión ingresada.")->warning();
            return redirect()->route('empleado.create');
        }
        $empleado = Empleado::find($id);
        foreach ($empleado->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key != 'correo') {
                    $empleado->$key = strtoupper($request->$key);
                } else {
                    $empleado->$key = $request->$key;
                }
            }
        }
        $result = $empleado->save();
        if ($result) {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('empleado.index');
        } else {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('empleado.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $empleado = Empleado::find($id);
        $result = $empleado->delete();
        if ($result) {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('empleado.index');
        } else {
            flash("El Empleado <strong>" . $empleado->nombres . " " . $empleado->apellidos . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('empleado.index');
        }
    }
}
