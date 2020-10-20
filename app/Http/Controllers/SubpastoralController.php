<?php

namespace App\Http\Controllers;

use App\Pastoral;
use App\Subpastoral;
use Illuminate\Http\Request;

class SubpastoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $subs = Subpastoral::all()->groupBy('pastoral_id');
        return view('pastoral.subpastorales.list')
            ->with('location', 'pastoral')
            ->with('subs', $subs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $datos = Pastoral::all()->sortBy('nombre');
        $pastorales = null;
        $pastorales = collect($pastorales);
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        return view('pastoral.subpastorales.create')
            ->with('location', 'pastoral')
            ->with('pastorales', $pastorales);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $sub = new Subpastoral($request->all());
        foreach ($sub->attributesToArray() as $key => $value) {
            $sub->$key = strtoupper($value);
        }
        $result = $sub->save();
        if ($result) {
            flash("La Subpastoral  <strong>" . $sub->nombre . "</strong> fue almacenada de forma exitosa!")->success();
            return redirect()->route('subpastoral.index');
        } else {
            flash("La Subpastoral <strong>" . $sub->nombre . "</strong> no pudo ser almacenada. Error: " . $result)->error();
            return redirect()->route('subpastoral.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Subpastoral $subpastoral
     * @return \Illuminate\Http\Response
     */
    public function show(Subpastoral $subpastoral) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Subpastoral $subpastoral
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $sub = Subpastoral::find($id);
        $datos = Pastoral::all()->sortBy('nombre');
        $pastorales = null;
        $pastorales = collect($pastorales);
        if (count($datos) > 0) {
            foreach ($datos as $item) {
                $pastorales[$item->id] = "PASTORAL " . $item->nombre;
            }
        }
        return view('pastoral.subpastorales.edit')
            ->with('location', 'pastoral')
            ->with('pastorales', $pastorales)
            ->with('sub', $sub);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Subpastoral $subpastoral
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $sub = Subpastoral::find($id);
        foreach ($sub->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                $sub->$key = strtoupper($request->$key);
            }
        }
        $result = $sub->save();
        if ($result) {
            flash("La Subpastoral <strong>" . $sub->nombre . "</strong> fue modificada de forma exitosa!")->success();
            return redirect()->route('subpastoral.index');
        } else {
            flash("La Subpastoral <strong>" . $sub->nombre . "</strong> no pudo ser modificada. Error: " . $result)->error();
            return redirect()->route('subpastoral.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Subpastoral $subpastoral
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $sub = Subpastoral::find($id);
        if (count($sub->comunidads) > 0) {
            return response()->json([
                'status' => 'warning',
                'message' => "La Subpastoral <strong>" . $sub->nombre . "</strong> no pudo ser eliminada porque tiene comunidades asociadas."
            ]);
        }
        $result = $sub->delete();
        if ($result) {
            return response()->json([
                'status' => 'ok',
                'message' => "La Subpastoral <strong>" . $sub->nombre . "</strong> fue eliminada de forma exitosa!"
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "La SubPastoral <strong>" . $sub->nombre . "</strong> no pudo ser eliminada. Error: " . $result
            ]);
        }
    }
}
