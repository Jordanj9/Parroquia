<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show the view menu usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios()
    {
        return view('menu.usuarios')->with('location', 'usuarios');
    }

    public function general()
    {
        return view('menu.general')->with('location', 'general');
    }

//    public function academico() {
//        return view('menu.academico')->with('location', 'academico');
//    }

//    public function intervencion()
//    {
//        return view('menu.intervencion')->with('location', 'intervencion');
//    }

    public function pastoral() {
        return view('menu.pastoral')->with('location', 'pastoral');
    }

    public function administracion()
    {
        return view('menu.administracion')->with('location', 'administracion');
    }
}
