@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Formulario Tablero</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tablero.store')}}">
                            @csrf
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}"/>
                            <div class="form-group">
                                <label for="nombre">Nombre del tablero</label>

                                <input id="nombre" type="text"
                                       class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                       value="{{ old('nombre') }}" required>

                                @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
