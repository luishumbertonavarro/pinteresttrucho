@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario Pin</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pin.update', $objPin->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}"/>

                            <div class="form-group">
                                <label for="titulo">Titulo</label>

                                <input id="titulo" type="text"
                                       class="form-control @error('titulo') is-invalid @enderror" name="titulo"
                                       value="{{ old('titulo', $objPin->titulo)}}" required>

                                @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tableroId">Tablero</label>

                                <select id="tableroId"
                                        class="form-control @error('tableroId') is-invalid @enderror" name="tableroId"
                                        required>
                                    @foreach($listaTablero as $objTablero)
                                        <option
                                            value="{{$objTablero->id}}" {{old('tableroId') == $objTablero->id? 'selected':''}}>
                                            {{$objTablero->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('tableroId')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Inserte la imagen del pin </label>
                                <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Datos
                                </button>&nbsp;
                                <a href="lista.blade.php">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
