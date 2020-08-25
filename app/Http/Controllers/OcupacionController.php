<?php

namespace App\Http\Controllers;

use App\Auditoriageneral;
use App\ocupacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ocupaciones = ocupacion::all();
        return view('general.ocupacion.list')
            ->with('location', 'general')
            ->with('ocupaciones', $ocupaciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('general.ocupacion.create')->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $ocupacion = new ocupacion($request->all());
        foreach ($ocupacion->attributesToArray() as $key => $value) {
            $ocupacion->$key = strtoupper($value);
        }
        $result = $ocupacion->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE OCUPACIÓN LABORAL. DATOS: ";
            foreach ($ocupacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('ocupacion.index');
        } else {
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('ocupacion.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ocupacion $ocupacion
     * @return \Illuminate\Http\Response
     */
    public function show(ocupacion $ocupacion) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ocupacion $ocupacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $ocupacion = ocupacion::find($id);
        return view('general.ocupacion.edit')
            ->with('location', 'general')
            ->with('ocupacion', $ocupacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ocupacion $ocupacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $ocupacion = ocupacion::find($id);
        $m = new  ocupacion($ocupacion->attributesToArray());
        foreach ($ocupacion->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $ocupacion->$key = strtoupper($request->$key);
            }
        }
        $result = $ocupacion->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE OCUPACIÓN. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($ocupacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('ocupacion.index');
        } else {
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('ocupacion.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ocupacion $ocupacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $ocupacion = ocupacion::find($id);
        $result = $ocupacion->delete();
        if ($result) {
            $aud = new Auditoriageneral();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE OCUAPACIÓN. DATOS ELIMINADOS: ";
            foreach ($ocupacion->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> fue eliminada de forma exitosa!")->success();
            return redirect()->route('ocupacion.index');
        } else {
            flash("La Ocupación <strong>" . $ocupacion->nombre . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('ocupacion.index');
        }
    }
}
