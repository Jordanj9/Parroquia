<?php

namespace App\Http\Controllers;

use App\Comunidad;
use App\Estadocivil;
use App\Miembro;
use App\ocupacion;
use App\Pastoral;
use App\Sacramento;
use App\Situacionespiritual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MiembroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $miembros = Miembro::all();
        return view('pastoral.miembros.list')
            ->with('location', 'pastoral')
            ->with('miembros', $miembros);
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
        $comunidades = Comunidad::all()->sortBy('numero');
        if (count($comunidades) > 0) {
            foreach ($comunidades as $item) {
                $string = "COMUNIDAD: " . $item->numero . " DÍA - HORA: " . $item->dia . " - " . $item->hora;
                $comu[$item->id] = $item->subpastoral_id != null ? $string . " SUBPASTORAL: " . $item->subpastoral->nombre : $string . " PASTORAL: " . $item->pastoral->nombre;
            }
        }
        $ocupaciones = ocupacion::all()->sortBy('nombre')->pluck('nombre', 'id');
        $estados = Estadocivil::all()->sortBy('nombre')->pluck('nombre', 'id');
        $situaciones = Situacionespiritual::all()->sortBy('nombre')->pluck('nombre', 'id');
        $sacramentos = Sacramento::all()->sortBy('nombre')->pluck('nombre', 'id');
        //dd($pastorales);
        return view('pastoral.miembros.create')
            ->with('location', 'pastoral')
            ->with('realidades', count($datos) > 0 ? $pastorales : $datos)
            ->with('comunidades', count($comunidades) > 0 ? $comu : $comunidades)
            ->with('ocupaciones', $ocupaciones)
            ->with('situaciones', $situaciones)
            ->with('sacramentos', $sacramentos)
            ->with('estados', $estados);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function show(Miembro $miembro) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function edit(Miembro $miembro) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Miembro $miembro) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Miembro $miembro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Miembro $miembro) {
        //
    }
}
