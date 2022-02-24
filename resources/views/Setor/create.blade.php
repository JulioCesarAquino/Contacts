@extends('layouts.app')
@section('content')
    <title>{{ config('app.name', 'Cadastro de Setor') }}</title>
    <div class="card-group">
        <div class="card-forms">
            <h4 class="card-title">Cadastramento de Setores</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="/add-setor">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Setor:</label>
                    <input type="text" class="form-control" name="name" placeholder="Ex. Infantil">
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
            </form>
        </div>
    </div>
@endsection
