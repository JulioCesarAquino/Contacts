<!------------------------->
<!------------------------->
<!-- Cards Administrador -->
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
        <div class="card-body">
            <h4 class="card-title text-muted mb-3">Peça rara - {{ $loja->name }}</h4>
            <div class="item">
                <img src="images/loja/{{ $loja->photo }}" class="card-img-top" alt="...">
            </div>
            <div class="d-flex mt-3">
                <div class="preview-list w-100">
                    <div class="flex-grow">
                        <div class="d-flex d-md-block d-xl-flex justify-content-between">
                            <h4 class="text-muted preview-subject"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt mb-1" viewBox="0 0 16 16" style="padding-top: -4px;">
                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"></path>
                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                                </svg> {{$loja->district}}</h4>
                            <p class="text-muted text-small">4 Hours Ago</p>
                        </div>
                        <span class="progress"></span>
                        <div class="row">
                            <div class="col ml-2 mt-2">
                                <p class="text-muted"><i class="mdi mdi-phone-classic"></i> {{$loja->phone}}</p>
                                <p class="text-muted"><i class="mdi mdi-email"></i> {{$loja->email}} </p>
                                <p class="text-muted"><i class="mdi mdi-google-maps"></i> {{$loja->city}} - {{$loja->uf}} </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span class="progress mb-3"></span>
            <div class="row mb-3">
                @auth
                <div class="col">
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#contact-{{ $loja->id }}"><i class="mdi mdi-account-multiple-plus"></i>Colab.</a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit-{{ $loja->id }}"><i class="mdi mdi-tooltip-edit"></i>Editar</a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#id-{{ $loja->id }}"><i class="mdi mdi-whatsapp"></i>Whats</a>
                </div>
                @endauth
                @guest
                <div class="col">
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#id-{{ $loja->id }}"><i class="mdi mdi-whatsapp"></i>WhatsApp</a>
                </div>
                @endguest
            </div>
            <small class="text-muted ml-2"><i class="mdi mdi-calendar-clock"></i> Segunda à Sábado: 9h00 às 19h00
            </small>

        </div>
    </div>
    <!-- Modal Contatos-->
    <div class="modal fade" id="contact-{{ $loja->id }}" tabindex="-1" role="dialog" aria-labelledby="contact-{{ $loja->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contact-{{ $loja->id }}">Adicionar novo vendedor -
                        {{ $loja->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-forms">
                        <form class="forms-sample" method="POST" enctype="multipart/form-data" action="/add-func">
                            @csrf
                            <div class="form-group">
                                <label id="peter" for="exampleInputName1">Nome Completo</label>
                                <input type="text" required="true" class="form-control" name="name_func" placeholder="Ex. Peter Parker">
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">WhatsApp</label>
                                <input type="text" class="form-control" name="whatsapp" placeholder="(xx)xxxxx-xxxx" onkeypress="$(this).mask('(00) 00000-0009')">
                            </div>
                            <div class=" form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="email" class="form-control" name="email_func" placeholder="user@admin.com.br">
                            </div>
                            <!-- Input tipo Hidden Envio do ID da Loja -->
                            <input type="hidden" id="custId" name="loja_func" value="{{ $loja->id }}">
                            <!-- ***** ***** ******-->
                            <div class="form-group">
                                <label>Setor</label>
                                <select class="form-control" name="setor_func" style="width:100%">
                                    <option selected>-- select --</option>
                                    @foreach ($setors as $setor)
                                    @foreach ($loja->sectors as $loja_setor)
                                    @if ($setor->id == $loja_setor)
                                    <option value="{{ $setor->id }}">{{ $setor->name }}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">&nbsp;</div>
                                <div class="col-md-4">
                                    <div class="image_area">
                                        <label for="fileFunc{{ $loja->id }}">
                                            <img src="images/user.png" class="img-responsive imgPhoto1" id="imgFunc{{ $loja->id }}" />
                                            <div class="overlay">
                                                <div class="text">
                                                    <p>ㅤㅤㅤㅤㅤㅤㅤclique para selecionar a imagem</p>
                                                </div>
                                            </div>
                                            <input required="true " type="file" accept="image/*" name="photo" id="fileFunc{{ $loja->id }}" style="display:none">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                        </form>
                        <script>
                            /* upload image edit */
                            /********************/
                            let imgFunc {
                                {
                                    $loja - > id
                                }
                            } = document.getElementById('imgFunc{{ $loja->id }}');
                            let fileFunc {
                                {
                                    $loja - > id
                                }
                            } = document.getElementById('fileFunc{{ $loja->id }}');

                            fileFunc {
                                {
                                    $loja - > id
                                }
                            }.addEventListener('change', (event) => {
                                let readerFunc {
                                    {
                                        $loja - > id
                                    }
                                } = new FileReader();

                                readerFunc {
                                    {
                                        $loja - > id
                                    }
                                }.onload = () => {
                                    imgFunc {
                                        {
                                            $loja - > id
                                        }
                                    }.src = readerFunc {
                                        {
                                            $loja - > id
                                        }
                                    }.result;
                                }
                                readerFunc {
                                    {
                                        $loja - > id
                                    }
                                }.readAsDataURL(fileFunc {
                                    {
                                        $loja - > id
                                    }
                                }.files[0]);
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edição -->
    <div class="modal fade" id="edit-{{ $loja->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-{{ $loja->id }}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-{{ $loja->id }}">Editar Unidade - {{ $loja->name }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-forms">
                        <h4 class="card-title">Cadastramento de unidades peça rara</h4>
                        <form class="forms-sample" method="POST" action="/edit" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $loja->id }}">
                            <div class="form-group">
                                <label for="exampleInputName1">Nome da Unidade</label>
                                <input type="text" class="form-control" value="{{ $loja->name }}" name="name" placeholder="Ex. 307 Sul" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail3">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $loja->email }}" placeholder="user@admin.com.br" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">Telefone</label>
                                <input type="text" class="form-control" name="phone" value="{{ $loja->phone }}" placeholder="(xx)xxxxx-xxxx" onkeypress="$(this).mask('(00) 0000-00009')" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputZip">CEP</label>
                                    <input type="text" class="form-control" value="{{ $loja->cep }}" name="cep" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Cidade</label>
                                    <input type="text" class="form-control" value="{{ $loja->city }}" name="city" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">UF</label>
                                    <select id="uf" name="uf" class="form-control" required>
                                        <option selected value="{{ $loja->uf }}">{{ $loja->uf }}</option>
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espirito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Bairro</label>
                                    <input type="text" class="form-control" value="{{ $loja->district }}" name="district" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Rua</label>
                                    <input type="text" class="form-control" value="{{ $loja->street }}" name="street" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Número</label>
                                    <input type="text" class="form-control" value="{{ $loja->number }}" name="number" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Setores</label>
                                <select class="js-example-basic-multiple" name="sectors[]" required multiple="multiple" style="width:100%">
                                    @foreach ($setors as $setor)
                                    {{$key = in_array($setor->id, $loja->sectors);}}
                                    <option {{($key == true) ? "selected='true'" : ""}} value="{{ $setor->id }}">{{ $setor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-4">&nbsp;</div>
                                <div class="col-md-4">
                                    <div class="image_area">
                                        <label for="editfile{{ $loja->id }}">
                                            <img src="images/loja/{{ $loja->photo }}" class="img-responsive imgPhoto" id="editImg{{ $loja->id }}" />
                                            <div class="overlay">
                                                <div class="text">
                                                    <p>ㅤㅤㅤㅤㅤㅤㅤclique para selecionar a imagem</p>
                                                </div>
                                            </div>
                                            <input type="file" name="photo" value="{{$loja->photo}}" accept="image/*" id="editfile{{ $loja->id }}" style="display:none">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Atualizar</button>
                        </form>
                    </div>
                </div>

                <script>
                    /* upload image edit */
                    /********************/
                    let photo {
                        {
                            $loja - > id
                        }
                    } = document.getElementById('editImg{{ $loja->id }}');
                    let file {
                        {
                            $loja - > id
                        }
                    } = document.getElementById('editfile{{ $loja->id }}');

                    file {
                        {
                            $loja - > id
                        }
                    }.addEventListener('change', (event) => {
                        let reader {
                            {
                                $loja - > id
                            }
                        } = new FileReader();

                        reader {
                            {
                                $loja - > id
                            }
                        }.onload = () => {
                            photo {
                                {
                                    $loja - > id
                                }
                            }.src = reader {
                                {
                                    $loja - > id
                                }
                            }.result;
                        }
                        reader {
                            {
                                $loja - > id
                            }
                        }.readAsDataURL(file {
                            {
                                $loja - > id
                            }
                        }.files[0]);
                    });
                </script>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Entre em contato -->
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
                    @foreach ($setors as $setor)
                    @foreach ($loja->sectors as $sector)
                    @if ($sector == $setor->id)
                    <ul class="nav-item menu-items">
                        <button type="button" class="btn btn-dark btn-lg btn-block" data-toggle="collapse" href="#ui-funcionario-{{ $setor->id }}" aria-expanded="false" aria-controls="ui-basic">
                            <span class="menu-title">{{ $setor->name }}</span>
                            <i class="menu-arrow"></i>
                        </button>
                        <div class="dropdown-list collapse" id="ui-funcionario-{{ $setor->id }}">
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
                                                @auth
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="btn btn-outline-success" target="true" href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/[^0-9]/', '', $funcionario->whatsapp) }}&text=Ol%C3%A1%20gostaria%20de%20tirar%20algumas%20d%C3%BAvidas.">
                                                        <i class="mdi mdi-whatsapp"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger ml-01 close-modal" onclick="acao()">
                                                        <i class="mdi mdi-delete"></i>
                                                    </a>
                                                    <script>
                                                        function acao() {
                                                            Swal.fire({
                                                                title: "Excluir colaborador",
                                                                text: "Tem certeza que deseja excluir colaborador!",
                                                                icon: "warning",
                                                                button: "Yes!",
                                                                showCloseButton: true,
                                                                showCancelButton: true,
                                                                focusConfirm: false,


                                                                cancelButtonText: 'Não!',

                                                            }).then((value) => {
                                                                if (value.isConfirmed) {

                                                                    fetch('/delete-func/{{ $funcionario->id }}').then(response => {
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

                                                </div>
                                                @endauth
                                                @guest
                                                <a class="badge badge-outline-success whats" target="true" href="https://api.whatsapp.com/send?phone=55{{ preg_replace('/[^0-9]/', '', $funcionario->whatsapp) }}&text=Ol%C3%A1%20gostaria%20de%20tirar%20algumas%20d%C3%BAvidas.">
                                                    <i class="mdi mdi-whatsapp"></i> WhatsApp
                                                </a>
                                                @endguest
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
@endsection