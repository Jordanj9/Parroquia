<?php

namespace App\Http\Controllers;

use App\Auditoriageneral;
use App\Situacionespiritual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SituacionespiritualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $situaciones = Situacionespiritual::all();
        return view('general.situacion_espiritual.list')
            ->with('location', 'general')
            ->with('situaciones', $situaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('general.situacion_espiritual.create')
            ->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $situacion = new Situacionespiritual($request->all());
        foreach ($situacion->attributesToArray() as $key => $value) {
            $situacion->$key = strtoupper($value);
        }
        $result = $situacion->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE SITUACIÓN ESPIRITUAL. DATOS: ";
            foreach ($situacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('situacionespiritual.index');
        } else {
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('situacionespiritual.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Situacionespiritual $situacionespiritual
     * @return \Illuminate\Http\Response
     */
    public function show(Situacionespiritual $situacionespiritual) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Situacionespiritual $situacionespiritual
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $situacion = Situacionespiritual::find($id);
        return view('general.situacion_espiritual.edit')
            ->with('location', 'general')
            ->with('situacion', $situacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Situacionespiritual $situacionespiritual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $situacion = Situacionespiritual::find($id);
        $m = new  Situacionespiritual($situacion->attributesToArray());
        foreach ($situacion->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $situacion->$key = strtoupper($request->$key);
            }
        }
        $result = $situacion->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE SITUACIÓN ESPIRITUAL. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($situacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('situacionespiritual.index');
        } else {
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('situacionespiritual.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Situacionespiritual $situacionespiritual
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $situacion = Situacionespiritual::find($id);
        $result = $situacion->delete();
        if ($result) {
            $aud = new Auditoriageneral();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE SITUACIÓN ESPIRITUAL. DATOS ELIMINADOS: ";
            foreach ($situacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> fue eliminada de forma exitosa!")->success();
            return redirect()->route('situacionespiritual.index');
        } else {
            flash("La Situación espiritual <strong>" . $situacion->nombre . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('situacionespiritual.index');
        }
    }
}
