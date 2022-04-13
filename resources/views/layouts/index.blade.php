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
                <img src="images/loja/{{ $loja->photo }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $loja->name }}</h5>
                    <div class="params">
                        <p class="card-text">{{ $loja->city }}</p>
                    </div>
                    <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#contact-{{ $loja->id }}"><i
                            class="mdi mdi-account-multiple-plus"></i>Colaborador</a>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit-{{ $loja->id }}"><i
                            class="mdi mdi-tooltip-edit"></i>ㅤEditarㅤ</a>
                </div>
            </div>
            <!-- Modal Contatos-->
            <div class="modal fade" id="contact-{{ $loja->id }}" tabindex="-1" role="dialog"
                aria-labelledby="contact-{{ $loja->id }}Label" aria-hidden="true">
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
                                        <input type="text" required="true" class="form-control" name="name_func"
                                            placeholder="Ex. Peter Parker">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone">WhatsApp</label>
                                        <input type="text" class="form-control" name="whatsapp"
                                            placeholder="(xx)xxxxx-xxxx" onkeypress="$(this).mask('(00) 00000-0009')">
                                    </div>
                                    <div class=" form-group">
                                        <label for="exampleInputEmail3">Email</label>
                                        <input type="email" class="form-control" name="email_func"
                                            placeholder="user@admin.com.br">
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
                                                    <img src="images/user.png" class="img-responsive imgPhoto1"
                                                        id="imgFunc{{ $loja->id }}" />
                                                    <div class="overlay">
                                                        <div class="text">
                                                            <p>ㅤㅤㅤㅤㅤㅤㅤclique para selecionar a imagem</p>
                                                        </div>
                                                    </div>
                                                    <input required="true "type="file" accept="image/*" name="photo" id="fileFunc{{ $loja->id }}"
                                                        style="display:none">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Enviar</button>
                                </form>
                                <script>
                                    /* upload image edit */
                                    /********************/
                                    let imgFunc{{ $loja->id }} = document.getElementById('imgFunc{{ $loja->id }}');
                                    let fileFunc{{ $loja->id }} = document.getElementById('fileFunc{{ $loja->id }}');
                        
                                    fileFunc{{ $loja->id }}.addEventListener('change', (event) => {
                                        let readerFunc{{ $loja->id }} = new FileReader();
                        
                                        readerFunc{{ $loja->id }}.onload = () => {
                                            imgFunc{{ $loja->id }}.src = readerFunc{{ $loja->id }}.result;
                                        }
                                        readerFunc{{ $loja->id }}.readAsDataURL(fileFunc{{ $loja->id }}.files[0]);
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
            <div class="modal fade" id="edit-{{ $loja->id }}" tabindex="-1" role="dialog"
                aria-labelledby="edit-{{ $loja->id }}Label" aria-hidden="true">
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
                                        <input type="text" class="form-control" value="{{ $loja->name }}" name="name"
                                            placeholder="Ex. 307 Sul">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail3">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ $loja->email }}" placeholder="user@admin.com.br">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone">Telefone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $loja->phone }}"
                                            placeholder="(xx)xxxxx-xxxx" onkeypress="$(this).mask('(00) 0000-00009')">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="inputZip">CEP</label>
                                            <input type="text" class="form-control" value="{{ $loja->cep }}"
                                                name="cep">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Cidade</label>
                                            <input type="text" class="form-control" value="{{ $loja->city }}"
                                                name="city">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputState">UF</label>
                                            <select id="uf" name="uf" class="form-control">
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
                                            <input type="text" class="form-control" value="{{ $loja->district }}"
                                                name="district">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputCity">Rua</label>
                                            <input type="text" class="form-control" value="{{ $loja->street }}"
                                                name="street">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="inputZip">Número</label>
                                            <input type="text" class="form-control" value="{{ $loja->number }}"
                                                name="number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Setores</label>
                                        <select class="js-example-basic-multiple" name="sectors[]" multiple="multiple" style="width:100%">
                                            @foreach ($setors as $setor)
                                                <option selected="true" value="{{ $setor->id }}">{{ $setor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">&nbsp;</div>
                                        <div class="col-md-4">
                                            <div class="image_area">
                                                <label for="editfile{{ $loja->id }}">
                                                    <img src="images/loja/{{ $loja->photo }}"
                                                        class="img-responsive imgPhoto" id="editImg{{ $loja->id }}" />
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
                            let photo{{ $loja->id }} = document.getElementById('editImg{{ $loja->id }}');
                            let file{{ $loja->id }} = document.getElementById('editfile{{ $loja->id }}');
                
                            file{{ $loja->id }}.addEventListener('change', (event) => {
                                let reader{{ $loja->id }} = new FileReader();
                
                                reader{{ $loja->id }}.onload = () => {
                                    photo{{ $loja->id }}.src = reader{{ $loja->id }}.result;
                                }
                                reader{{ $loja->id }}.readAsDataURL(file{{ $loja->id }}.files[0]);
                            });
                        </script>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
