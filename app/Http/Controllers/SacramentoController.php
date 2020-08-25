<?php

namespace App\Http\Controllers;

use App\Auditoriageneral;
use App\Sacramento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SacramentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sacramentos = Sacramento::all();
        return view('general.sacramentos.list')
            ->with('location', 'general')
            ->with('sacramentos', $sacramentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('general.sacramentos.create')->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $sacramento = new Sacramento($request->all());
        foreach ($sacramento->attributesToArray() as $key => $value) {
            $sacramento->$key = strtoupper($value);
        }
        $result = $sacramento->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "INSERTAR";
            $str = "CREACIÓN DE SACRAMENTO. DATOS: ";
            foreach ($sacramento->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('sacramentos.index');
        } else {
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> no pudo ser almacenado. Error: " . $result)->error();
            return redirect()->route('sacramentos.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sacramento $sacramento
     * @return \Illuminate\Http\Response
     */
    public function show(Sacramento $sacramento) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sacramento $sacramento
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $sacramento = Sacramento::find($id);
        return view('general.sacramentos.edit')
            ->with('location', 'general')
            ->with('sacramento', $sacramento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sacramento $sacramento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $sacramento = Sacramento::find($id);
        $m = new  Sacramento($sacramento->attributesToArray());
        foreach ($sacramento->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $sacramento->$key = strtoupper($request->$key);
            }
        }
        $result = $sacramento->save();
        if ($result) {
            $u = Auth::user();
            $aud = new Auditoriageneral();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ACTUALIZAR DATOS";
            $str = "EDICION DE SACRAMENTO. DATOS NUEVOS: ";
            $str2 = " DATOS ANTIGUOS: ";
            foreach ($m->attributesToArray() as $key => $value) {
                $str2 = $str2 . ", " . $key . ": " . $value;
            }
            foreach ($sacramento->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('sacramentos.index');
        } else {
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('sacramentos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sacramento $sacramento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $sacramento = Sacramento::find($id);
        $result = $sacramento->delete();
        if ($result){
            $aud = new Auditoriageneral();
            $u = Auth::user();
            $aud->usuario = "ID: " . $u->identificacion . ",  USUARIO: " . $u->nombres . " " . $u->apellidos;
            $aud->operacion = "ELIMINAR";
            $str = "ELIMINACIÓN DE SACRAMENTO. DATOS ELIMINADOS: ";
            foreach ($sacramento->attributesToArray() as $key => $value) {
                $str = $str . ", " . $key . ": " . $value;
            }
            $aud->detalles = $str;
            $aud->save();
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> fue eliminado de forma exitosa!")->success();
            return redirect()->route('sacramentos.index');
        }else{
            flash("El Sacramento <strong>" . $sacramento->nombre . "</strong> no pudo ser eliminado. Error: " . $result)->error();
            return redirect()->route('sacramentos.index');
        }
    }
}
