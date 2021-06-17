<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaTableros = Tablero::with('usuarioCreador')->get();
        return view('tablero.lista', compact('listaTableros'));
    }
}
