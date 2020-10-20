<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Lider;
use App\Miembro;
use App\Pastoral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $eventos = Evento::all();
        return view('agenda.list')
            ->with('location', 'agenda')
            ->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lideres = Lider::all();
        $miembros = Miembro::all();
        $personas = collect();
        if (count($lideres) > 0) {
            foreach ($lideres as $item) {
                $personas[$item->id . "-L"] = $item->identificacion . " - " . $item->nombre;
            }
        }
        if (count($miembros) > 0) {
            foreach ($miembros as $item) {
                $personas[$item->id . "-M"] = $item->identificacion . " - " . $item->nombres . " " . $item->apellidos;
            }
        }
        $array = null;
        $array = collect($array);
        DB::table('administracions')->orderBy('id')->chunk(100, function ($admins) use ($array) {
            foreach ($admins as $admin) {
                $array[$admin->id] = $admin->fecha_inicio . " - " . $admin->fecha_fin . " ESTADO: " . $admin->estado;
            }
        });
        $datos = Pastoral::all()->sortBy('nombre');
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre . " - PARROQUIA: " . $item->parroquia->nombre;
            }
        }
        return view('agenda.create')
            ->with('location', 'agenda')
            ->with('personas', $personas)
            ->with('admins', $array)
            ->with('pastorales', count($datos) > 0 ? $pastorales : $datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $evento = new Evento($request->all());
        foreach ($evento->attributesToArray() as $key => $value) {
            $evento->$key = strtoupper($value);
        }
        $aux = explode('-', $request->persona);
        if ($aux[1] == 'L') {
            $per = Lider::find($aux[0]);
            $evento->responsable = $per->identificacion . " - " . $per->nombre;
        } else {
            $mim = Miembro::find($aux[0]);
            $evento->responsable = $mim->identificacion . " - " . $mim->nombres . " " . $mim->apellidos;
        }
        $result = $evento->save();
        if ($result) {
            flash("EL evento <strong>" . $evento->nombre . " fue almacenado correctamente.")->success();
            return redirect()->route('evento.index');
        } else {
            flash("El evento <strong>" . $evento->nombre . "</strong> no pudo ser guardado. Error: " . $result)->warning();
            return redirect()->route('evento.index');
        }
//        dd($evento);
//        $result = $evento->
//        $date = strtotime($evento->fecha);
//        $date = date('Y-m-d H:i:s', $date);
//        $evento->fecha = $date;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Evento $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Evento $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Evento $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Evento $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento) {
        //
    }

    public function listar(){
        $agenda = [];
            $eventos = Evento::all();
            $agenda =  $this->agenda($eventos);
        return response()->json($agenda);
    }

    function agenda($eventos){
        $agendad = [];
        foreach ($eventos as $evento) {
                $agenda[] = [
                    'title' => $evento->nombre,
                    'start' =>  $evento->fecha,
                    'responsable' => $evento->responsable,
                    'lugar' => $evento->lugar,
                    'pastoral' => $evento->pastoral->nombre,
                    'color' => 'purple',
                ];
        }
        return $agenda;
    }
}
