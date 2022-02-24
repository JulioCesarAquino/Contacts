@extends('layouts.app')

@section('content')
    <div class="card-group">
        @foreach ($lojas as $loja)
        <div class="card-unidade">
            <img src="images/loja/{{$loja->photo}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$loja->name}}</h5>
                <div class="params">
                    <p class="card-text">{{$loja->city}}</p>
                </div>        
                <a href="#" class="btn btn-success">WhatsApp</a>
                <button class="btn btn-primary"> Editar </button>
            </div>
        </div>
        @endforeach
    </div>

@endsection
