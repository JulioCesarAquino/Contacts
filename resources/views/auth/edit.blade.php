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
                <h4 class="card-title">Usuários</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> Nome </th>
                                <th> ID </th>
                                <th> Email </th>
                                <th> Data de Criação </th>
                                <th> Ações </th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tbody>
                            <tr>
                                <td class="td-photo">
                                <i class="bi font-size-icon bi-person-circle"></i>
                                </td>
                                <td class="pl-2 mr-4">
                                    <span class="pl-2">{{ $user->name }}</span>
                                </td>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->email }} </td>
                                <td> {{ $user->created_at }} </td>
                                <td>                               
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="acao()" class="btn btn-outline-danger">Deletar</button>                                  
                                </td>
                            </tr>
                        </tbody>
                        <script>
                            function acao() {
                                Swal.fire({
                                    title: "Excluir Registro da loja!",
                                    text: "Tem certeza que deseja excluir a Unidade!",
                                    icon: "warning",
                                    button: "Yes!",
                                    showCloseButton: true,
                                    showCancelButton: true,
                                    focusConfirm: false,
                                    cancelButtonText: 'Não',

                                }).then((value) => {
                                    if (value.isConfirmed) {

                                        fetch('/destroy/{{$user->id}}').then(response => {
                                            console.log(response)
                                            if (response.redirected) {
                                                location.href = '/delete'
                                            }
                                        }).catch(err => {
                                            console.log(err)

                                        })
                                    }
                                });
                            }

                            function fechar() {
                                let modal = document.querySelector('.modalAlert')
                                modal.style.display = 'none';
                            }
                        </script>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection