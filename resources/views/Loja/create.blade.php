@extends('layouts.app')
<title>{{ config('app.name', 'Adicionar Loja') }}</title>
@section('content')
    <div class="card-group">
        <div class="card-forms">
            <h4 class="card-title">Cadastramento de unidades peça rara</h4>
            <form class="forms-sample" method="POST" enctype="multipart/form-data" action="/add">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Nome da Unidade</label>
                    <input type="text" class="form-control" name="name" placeholder="Ex. 307 Sul" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail3">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="user@admin.com.br" required>
                </div>
                <div class="form-group">
                    <label for="inputPhone">Telefone</label>
                    <input type="text" class="form-control" name="phone" placeholder="(xx)xxxxx-xxxx" onkeypress="$(this).mask('(00) 00000-0009')" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="inputZip">CEP</label>
                        <input type="text" class="form-control" name="cep" onkeypress="$(this).mask('00000-000')" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputCity">Cidade</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">UF</label>
                        <select id="uf" name="uf" class="form-control" required>
                            <option selected>Selecione...</option>
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
                        <input type="text" class="form-control" name="district" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCity">Rua</label>
                        <input type="text" class="form-control" name="street" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Número</label>
                        <input type="text" class="form-control" name="number" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Setores</label>
                    <select class="js-example-basic-multiple" name="sectors[]" multiple="multiple" style="width:100%" required>
                        @foreach ($setors as $setor)
                            <option value="{{ $setor->id }}">{{ $setor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <div class="image_area">
                            <label for="fileImage">
                                <img src="images/storee.png" class="img-responsive imgPhoto" id="imgPhoto"/>
                                <div class="overlay">
                                    <div class="text"><p>Selecione a Imagem</p></div>
                                </div>
                                <input type="file" name="photo" id="fileImage"
                                    style="display:none" accept="image/*" required>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Enviar</button>
            </form>
        </div>
    </div>
    <script>
        let photo = document.getElementById('imgPhoto');
        let file = document.getElementById('fileImage');
        
            file.addEventListener('change', (event) => {
                 let reader = new FileReader();

                 reader.onload = () => {
                     photo.src = reader.result;
                 }
                 reader.readAsDataURL(file.files[0]);
            });
    </script>
@endsection
