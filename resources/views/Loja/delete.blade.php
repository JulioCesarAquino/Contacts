@extends('layouts.app')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Tudo Certo!</strong> {{session('msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row ">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Deletar Unidade</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Nome da Unidade </th>
                                    <th> Estado </th>
                                    <th> Cidade </th>
                                    <th> Bairro </th>
                                    <th> Data de Criação </th>
                                    <th> Ações </th>
                                </tr>
                            </thead>
                            @foreach ($lojas as $loja)
                                <tbody>
                                    <tr>
                                        <td class="td-photo">
                                            <img src="images/loja/{{ $loja->photo }}" alt="image" />
                                        </td>
                                        <td class="pl-2 mr-4">
                                            <span class="pl-2">PR - {{ $loja->name }}</span>
                                        </td>
                                        <td> {{ $loja->uf }} </td>
                                        <td> {{ $loja->city }} </td>
                                        <td> {{ $loja->district }} </td>
                                        <td> {{ $loja->created_at }} </td>
                                        <td>
                                            <form action="/delete/{{ $loja->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-outline-danger">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
