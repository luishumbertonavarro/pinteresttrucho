@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lista de Tablero</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Creado por</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listaTableros as $objTablero)
                                <tr>
                                    <td>{{$objTablero->id}}</td>
                                    <td>{{$objTablero->nombre}}</td>
                                    <td>{{$objTablero->usuarioCreador->name}}</td>
                                    @if(Route::has('login') && Auth::user()->name== $objTablero->usuarioCreador->name)
                                    <td><a class="btn btn-primary"
                                           href="{{ route('tablero.edit',$objTablero->id) }}">Editar</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('tablero.destroy',$objTablero->id) }}">
                                            @csrf
                                            @method("DELETE")
                                            <input type="submit" class="btn btn-danger"
                                                   onclick="return confirm('¿Está seguro que desea eliminar el tablero?')"
                                                   value="Eliminar"/>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
