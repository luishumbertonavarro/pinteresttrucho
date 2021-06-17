@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center d-flex justify-content-around">

            @foreach($listaPin as $objPin)
                <div class="card " style="width: 18rem; margin-bottom: 10px;">
                    <img class="card-img-top" src="{{asset('images'.$objPin->url)}}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$objPin->titulo}}</p>
                    </div>
                    <a class="btn btn-success"
                       href="{{ route('pin.ver',$objPin->id) }}">Ver</a>

                    @if(Route::has('login') && Auth::user()->name== $objPin->usuarioCreadorPin->name)
                        <div class="card-body">
                            <a class="btn btn-primary"
                               href="{{ route('pin.edit',$objPin->id) }}">Editar</a>

                            <form method="POST" action="{{ route('pin.destroy',$objPin->id) }}">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-danger mt-3"
                                       onclick="return confirm('¿Está seguro que desea eliminar el pin?')"
                                       value="Eliminar"/>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
