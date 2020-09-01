<?php

namespace App\Http\Controllers;

use App\Parroquia;
use App\Pastoral;
use Illuminate\Http\Request;

class PastoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pastorales = Pastoral::all()->sortBy('nombre');
        return view('pastoral.pastorales.list')
            ->with('location', 'pastoral')
            ->with('pastorales', $pastorales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parroquias = Parroquia::all()->sortBy('nombre')->pluck('nombre', 'id');
        return view('pastoral.pastorales.create')
            ->with('location', 'pastoral')
            ->with('parroquias', $parroquias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $pastoral = new Pastoral($request->all());
        foreach ($pastoral->attributesToArray() as $key => $value) {
            $pastoral->$key = strtoupper($value);
        }
        $result = $pastoral->save();
        if ($result) {
            flash("La Pastoral <strong>" . $pastoral->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('pastorales.index');
        } else {
            flash("La Pastoral <strong>" . $pastoral->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('pastorales.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Pastoral $pastoral
     * @return \Illuminate\Http\Response
     */
    public function show(Pastoral $pastoral) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Pastoral $pastoral
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $pastoral = Pastoral::find($id);
        $parroquias = Parroquia::all()->pluck('nombre', 'id');
        return view('pastoral.pastorales.edit')
            ->with('location', 'pastoral')
            ->with('pastoral', $pastoral)
            ->with('parroquias', $parroquias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Pastoral $pastoral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pastoral = Pastoral::find($id);
        foreach ($pastoral->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $pastoral->$key = strtoupper($request->$key);
            }
        }
        $result = $pastoral->save();
        if ($result) {
            flash("La Pastoral <strong>" . $pastoral->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('pastorales.index');
        } else {
            flash("La Pastoral <strong>" . $pastoral->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('pastorales.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Pastoral $pastoral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $pastoral = Pastoral::find($id);
        if (count($pastoral->comunidads) > 0 || count($pastoral->subpastorals) > 0) {
            return response()->json([
                'status' => 'warning',
                'message' => "La Pastoral <strong>" . $pastoral->nombre . "</strong> no pudo ser eliminada porque tiene comunidades o subpastorales asociadas."
            ]);
        }
        $result = $pastoral->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "La Pastoral <strong>" . $pastoral->nombre . "</strong> fue eliminada de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "La Pastoral <strong>" . $pastoral->nombre . "</strong> no pudo ser eliminada. Error: " . $result
            ]);
        }
    }
}
