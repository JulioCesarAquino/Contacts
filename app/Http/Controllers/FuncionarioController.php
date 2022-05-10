<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $Funcionario = new Funcionario;
        $Funcionario->name = $request->name_func;
        $Funcionario->whatsapp = $request->whatsapp;
        $Funcionario->email = $request->email_func;
        $Funcionario->loja_id = $request->loja_func;
        $Funcionario->setor_id = $request->setor_func;
        $Funcionario->photo = $this->redimensionarImg($request, 'images/funcionario/', 100 , 100);
        $Funcionario->save();
        return redirect('/index')->with('msg', 'Colaborador cadastrado com sucesso!!');
    }

    public function destroy($id)
    {
        Funcionario::FindOrFail($id)->delete();

        return redirect('/index')->with('msg', 'Funcionário Deletado com Sucesso!!');
    }
}
