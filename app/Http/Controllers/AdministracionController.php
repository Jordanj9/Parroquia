<?php

namespace App\Http\Controllers;

use App\Administracion;
use App\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdministracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $admins = Administracion::all()->sortByDesc('fecha_inicio');
        return view('administracion.administracion.list')
            ->with('location', 'administracion')
            ->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parroquias = Parroquia::all()->pluck('nombre', 'id');
        return view('administracion.administracion.create')
            ->with('location', 'administracion')
            ->with('parroquias', $parroquias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $existe = Administracion::where([['fecha_inicio', '<=', $request->fecha_inicio], ['fecha_fin', '>=', $request->fecha_fin], ['parroquia_id', $request->parroquia_id]])->first();
        //$existe = Administracion::whereBetween('fecha_inicio',[$request->fecha_inicio,$request->fecha_fin])->orWhereBetween('fecha_fin',[$request->fecha_inicio,$request->fecha_fin])->first();
//        $existe = DB::table('administracions')
//            ->where('parroquia_id', $request->parroquia_id)
//            ->where(function ($query) use ($request) {
//                $query->whereBetween('fecha_inicio', [$request->fecha_inicio, $request->fecha_fin])
//                    ->orWhereBetween('fecha_fin', [$request->fecha_inicio, $request->fecha_fin]);
//            })->first();
        if ($existe != null) {
            flash("<strong>Atencion!.</strong> Ya existe un período para la fecha seleccionada. " . $request->fecha_inicio . " - " . $request->fecha_fin)->warning();
            return redirect()->route('administracion.create');
        }
        $admin = new Administracion($request->all());
        foreach ($admin->attributesToArray() as $key => $value) {
            $admin->$key = strtoupper($value);
        }
        $activo = Administracion::where([['estado', 'ACTIVO'], ['parroquia_id', $request->parroquia_id]])->first();
        if ($activo != null) {
            $admin->estado = 'INACTIVO';
        } else {
            $admin->estado = 'ACTIVO';
        }
        $result = $admin->save();
        if ($result) {
            flash("El Período de Administracion <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('administracion.index');
        } else {
            flash("El Período de Administracion <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('administracion.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Administracion $administracion
     * @return \Illuminate\Http\Response
     */
    public function show(Administracion $administracion) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Administracion $administracion
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $admin = Administracion::find($id);
        $parroquias = Parroquia::all()->pluck('nombre', 'id');
        return view('administracion.administracion.edit')
            ->with('location', 'administracion')
            ->with('parroquias', $parroquias)
            ->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Administracion $administracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $existe = Administracion::where([['fecha_inicio', '<=', $request->fecha_inicio], ['fecha_fin', '>=', $request->fecha_fin], ['parroquia_id', $request->parroquia_id]])->first();
        if ($existe != null && $existe->id != $id) {
            flash("<strong>Atencion!.</strong> Ya existe un período para la fecha seleccionada. " . $request->fecha_inicio . " - " . $request->fecha_fin)->warning();
            return redirect()->route('administracion.edit', $id);
        }
        $admin = Administracion::find($id);
        foreach ($admin->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $admin->$key = strtoupper($request->$key);
            }
        }
        if ($request->estado == 'ACTIVO') {
            $existe = Administracion::where([['estado', 'ACTIVO'], ['parroquia_id', $request->parroquia_id]])->first();
            if ($existe != null) {
                flash("<strong>Atención!.</strong> Ya existe un período ACTIVO.")->warning();
                return redirect()->route('administracion.edit', $id);
            }
        }
        $result = $admin->save();
        if ($result) {
            flash("El Período <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('administracion.index');
        } else {
            flash("El Período <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('administracion.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Administracion $administracion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $admin = Administracion::find($id);
        $admin->estado = 'INACTIVO';
        if ($admin->save()) {
            flash("El Período <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> cambio de estado correctamente.")->success();
            return redirect()->route('administracion.index');
        } else {
            flash("El Período <strong>" . $admin->fecha_inicio . " - " . $admin->fecha_fin . "</strong> no se pudo cambiar de estado.")->warning();
            return redirect()->route('administracion.index');
        }
    }
}
