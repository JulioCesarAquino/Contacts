@extends('layouts.app')
@section('content')
@if (session('msg'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Tudo Certo!</strong> {{ session('msg') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="card-group">
    @foreach ($lojas as $loja)
    <div class="card-unidade">
        <img src="images/loja/{{ $loja->photo }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $loja->name }}</h5>
            <div class="params">
                <p class="card-text">{{ $loja->city }}</p>
            </div>
            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#id-{{ $loja->id }}"><i class="mdi mdi-whatsapp"></i> WhatsApp</a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="id-{{ $loja->id }}" tabindex="-1" role="dialog" aria-labelledby="id-{{ $loja->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="id-{{ $loja->id }}">Entre em contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($setores as $setor)
                    @foreach ($loja->sectors as $sector)
                    @if ($sector == $setor->id)
                    <ul class="nav-item menu-items">
                        <button type="button" class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#ui-funcionario-{{ $setor->id }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">{{ $setor->name }}</span>
                            <i class="menu-arrow"></i>
                        </button>
                        <div class="dropdown-list collapse" id="ui-funcionario-{{ $setor->id }}" style="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> Colaborador </th>
                                            <th> Email </th>
                                            <th> Contatar </th>
                                        </tr>
                                    </thead>
                                    @foreach ($funcionarios as $funcionario)
                                    @if ($funcionario->setor_id == $setor->id and $funcionario->loja_id == $loja->id)
                                    <tbody>
                                        <tr>
                                            <td class="td-photo">
                                                <img src="images/funcionario/{{ $funcionario->photo }}" alt="image" />
                                            </td>
                                            <td class="pl-2 mr-4">
                                                <span class="pl-2">{{ $funcionario->name }}</span>
                                            </td>
                                            <td> {{ $funcionario->email }} </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-outline-success" target="
                                                                                            true" href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/[^0-9]/', '', $funcionario->whatsapp) }}">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger ml-01 close-modal" onclick="acao()">
                                                        <i class="mdi mdi-delete"></i>
                                                    
                                                    </a>
                                                    <div class="modalAlert">
                                                        <a onclick="fechar()" class="close-modal">Close</a>
                                                        <p>Second !</p>
                                                    </div>
                                                    <script>
                                                        function acao() {
                                                            let modal = document.querySelector('.modalAlert')
                                                            modal.style.display = 'block';
                                                        }

                                                        function fechar() {
                                                            let modal = document.querySelector('.modalAlert')
                                                            modal.style.display = 'none';
                                                        }
                                                    </script>
                                                    <form action="/delete-func/{{ $funcionario->id }}" method="POST">
                                                        @csrf
                                                        @method('delete')

                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </ul>
                    @endif
                    @endforeach
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modalEx" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modalFunc">
                <div class="modal-body">
                    Confirmar a exclusão!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Deletar</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<script>
    $("#btn4").click(function() {
        swal({
            title: "Atenção!",
            text: "Clique no botão para ser redirecionado!",
            icon: "warning",
            buttons: true,
        }).then(function(result) {
            if (result) {
                alert("Coloque aqui o window.location.href");
            } else {
                alert("Você não será redirecionado pois clicou em \"Cancel\"");
            }
        });
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection