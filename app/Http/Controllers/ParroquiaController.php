<?php

namespace App\Http\Controllers;

use App\Auditoriageneral;
use App\Parroquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParroquiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $parroquias = Parroquia::all();
        return view('general.parroquia.list')
            ->with('location', 'general')
            ->with('parroquias', $parroquias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('general.parroquia.create')
            ->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $parroquia = new Parroquia($request->all());
        foreach ($parroquia->attributesToArray() as $key => $value) {
            $parroquia->$key = strtoupper($value);
        }
        $result = $parroquia->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE PARROQUIA. DATOS: ";
            foreach ($parroquia->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('parroquia.index');
        } else {
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('parroquia.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Parroquia $parroquia
     * @return \Illuminate\Http\Response
     */
    public function show(Parroquia $parroquia) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Parroquia $parroquia
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $parroquia = Parroquia::find($id);
        return view('general.parroquia.edit')
            ->with('location', 'general')
            ->with('parroquia', $parroquia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Parroquia $parroquia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $parroquia = Parroquia::find($id);
        $m = new  Parroquia($parroquia->attributesToArray());
        foreach ($parroquia->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $parroquia->$key = strtoupper($request->$key);
            }
        }
        $result = $parroquia->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE PARROQUIA. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($parroquia->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('parroquia.index');
        } else {
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('parroquia.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Parroquia $parroquia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $parroquia = Parroquia::find($id);
        if (count($parroquia->administracions) > 0) {
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> no se puede eliminar porque tiene administraciones asociadas.")->warning();
            return redirect()->route('parroquia.index');
        }
        $result = $parroquia->delete();
        if ($result) {
            $aud = new Auditoriageneral();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE PARROQUIA. DATOS ELIMINADOS: ";
            foreach ($parroquia->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> fue eliminada de forma exitosa!")->success();
            return redirect()->route('parroquia.index');
        } else {
            flash("La Parroquia <strong>" . $parroquia->nombre . "</strong> no pudo ser eliminada. Error: " . $result)->error();
            return redirect()->route('parroquia.index');
        }
    }
}
