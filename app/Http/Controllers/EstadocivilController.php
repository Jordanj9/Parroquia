<?php

namespace App\Http\Controllers;

use App\Auditoriageneral;
use App\Estadocivil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstadocivilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $estados = Estadocivil::all();
        return view('general.estado_civil.list')
            ->with('location', 'general')
            ->with('estados', $estados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('general.estado_civil.create')
            ->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $estado = new Estadocivil($request->all());
        foreach ($estado->attributesToArray() as $key => $value) {
            $estado->$key = strtoupper($value);
        }
        $result = $estado->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PARROQUIA. DATOS: ";
            foreach ($estado->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Estado civil <strong>" . $estado->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('estadocivil.index');
        } else {
            flash("El Estado civil <strong>" . $estado->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('estadocivil.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Estadocivil $estadocivil
     * @return \Illuminate\Http\Response
     */
    public function show(Estadocivil $estadocivil) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Estadocivil $estadocivil
     * @return \Illuminate\Http\Response
     */
    public function edit(Estadocivil $estadocivil) {
        return view('general.estado_civil.edit')
            ->with('location', 'general')
            ->with('estado', $estadocivil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Estadocivil $estadocivil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $estado = Estadocivil::find($id);
        $m = new Estadocivil($estado->attributesToArray());
        foreach ($estado->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $estado->$key = strtoupper($request->$key);
            }
        }
        $result = $estado->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE ESTADO CIVIL. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($estado->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            flash("El Estado civil <strong>" . $estado->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('estadocivil.index');
        } else {
            flash("El Estado civil <strong>" . $estado->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('estadocivil.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Estadocivil $estadocivil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $estadocivil = Estadocivil::find($id);
        $result = $estadocivil->delete();
        if ($result) {
            $aud = new Auditoriageneral();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE PARROQUIA. DATOS ELIMINADOS: ";
            foreach ($estadocivil->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Estado civil <strong>" . $estadocivil->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('estadocivil.index');
        } else {
            flash("El Estado civil <strong>" . $estadocivil->nombre . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('estadocivil.index');
        }
    }
}
