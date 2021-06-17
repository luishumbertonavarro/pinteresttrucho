<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Tablero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->get('titulo')!=null){
            $titulo=$request->get('titulo');

            $listaPin=Pin::where('titulo','LIKE',"%".$titulo."%")->simplePaginate(3);
            return view('pin.lista',compact('listaPin'));
        }
        if($request->get('pinId')!=null){
            $listaPin = Pin::find($request->get('pinId'));
            return view('pin.lista', compact('listaPin'));
        }

        $listaPin = Pin::with('tableroPertenece')->get();
        return view('pin.lista', compact('listaPin'));
    }
    public function ver($id)
    {
        $objPin = Pin::find($id);
        if ($objPin == null) {
            return response()->redirectTo('/pin');
        }
        $listaTablero = Tablero::all();

        return view('pin.ver', compact('objPin','listaTablero'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaTablero = Tablero::all();
        return view('pin.form', compact('listaTablero'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'titulo' => ['required'],
            'foto' => ['required'],
            'tableroId' => ['required'],
            'userId'=>['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $imgName = time() . '-' . $request->titulo . '-' .
            $request->foto->extension();

        $request->foto->move(public_path('images'), $imgName);
        $objPin = Pin::create([
            'titulo' => $request->input('titulo'),
            'foto' => $imgName,
            'tableroId' => $request->input('tableroId'),
            'usuarioCreador'=>$request->input('userId'),
            'url' => '/' . $imgName
        ]);

        $objPin->save();
        return response()->redirectTo('/pin');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Pin $pin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Pin $pin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objPin = Pin::find($id);
        if ($objPin == null) {
            return response()->redirectTo('/pin');
        }
        $listaTablero = Tablero::all();

        return view('pin.edit', compact('objPin','listaTablero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pin $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $objPin = Pin::find($id);
        if ($objPin == null) {
            return response()->redirectTo('/pin');
        }
        $validator = Validator::make($request->all(), [
            'titulo' => [],
            'foto' => [],
            'tableroId' => []
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->get('titulo') != null) {
            $objPin->titulo = $request->get('titulo');
        }
        if ($request->get('foto') != null) {
            $imgName = time() . '-' . $request->titulo . '-' . $request->foto->extension();
            $request->foto->move(public_path('images'), $imgName);
            $objPin->foto = $imgName;
            $objPin->url='/'.$imgName;
        }
        if ($request->get('tableroId') != null) {
            $objPin->tableroId = $request->get('tableroId');
        }
        $objPin->save();
        return response()->redirectTo('/pin');
    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Models\Pin $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $objPin = Pin::find($id);
        if ($objPin == null) {
            return response()->redirectTo('/pin');
        }
        $objPin->delete();
        return response()->redirectTo('/pin');
    }
}
