<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $listaTableros = Tablero::with('usuarioCreador')->get();
        return view('tablero.lista', compact('listaTableros'));
    }


    public function create()
    {
        return view('tablero.form');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'userId' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $objTablero = Tablero::create($request->all());
        $objTablero->save();
        return response()->redirectTo('/tablero');
    }

    public function show(Tablero $tablero)
    {
        //
    }

    public function edit($id)
    {
        $objTablero = Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tablero');
        }

        return view('tablero.edit', compact('objTablero'));
    }


    public function update(Request $request, $id)
    {
        $objTablero = Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tablero');
        }
        $validator = Validator::make($request->all(), [
            'nombre' => ['required','string'],
            'userId' => []
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->get('nombre') != null) {
            $objTablero->nombre = $request->get('nombre');
        }
        if ($request->get('userId') != null) {
            $objTablero->userId = $request->get('userId');
        }
        $objTablero->fill($request->json()->all());
        $objTablero->save();
        return response()->redirectTo('/tablero');
    }


    public function destroy(Request $request, $id)
    {
        $objTablero = Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tablero');
        }
        $objTablero->delete();
        return response()->redirectTo('/tablero');

    }
}
