<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\Setor;
use Hamcrest\Arrays\IsArray;
use PhpParser\Node\Expr\Exit_;

class LojaController extends Controller
{
    //
    public function index()
    {
        $lojas = Loja::all();
        $setors = Setor::all();
        return view('layouts.index', ['lojas' => $lojas], ['setors' => $setors]);
    }

    public function indice()
    {
        $lojas = Loja::all();
        // $lojinha = Loja::findOrFail(2);
        $funcionarios = Funcionario::all();
        $setores = Setor::all();
        return view('welcome')->with('lojas', $lojas)->with('setores', $setores)->with('funcionarios', $funcionarios);
    }

    public function create()
    {

        $setors = Setor::all();
        return view('loja.create', ['setors' => $setors]);
    }

    public function store(Request $request)
    {

        $Loja = new Loja;
        $Loja->name     = ucfirst($request->name);
        $Loja->email    = $request->email;
        $Loja->phone    = $request->phone;
        $Loja->cep      = $request->cep;
        $Loja->city     = ucfirst($request->city);
        $Loja->uf       = $request->uf;
        $Loja->district = ucfirst($request->district);
        $Loja->street   = ucfirst($request->street);
        $Loja->number   = $request->number;
        $Loja->sectors  = $request->sectors; 
        $Loja->photo = $this->redimensionarImg($request, 'images/loja/', 324, 172);
        $Loja->save();
        return redirect('/')->with('msg', 'Unidade cadastrada com sucesso!!');
    }


    public function delete()
    {
        $lojas = Loja::all();
        return view('loja.delete', ['lojas' => $lojas]);
    }

    public function destroy($id)
    {
        Loja::FindOrFail($id)->delete();

        return redirect('/delete')->with('msg', 'Unidade Excluida com Sucesso!!');
    }

    public function update(Loja $Loja, Request $request){
    
        $Loja->FindOrFail($request->id)->update([
            'name'      => ucfirst($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'cep' => $request->cep,
            'city' => ucfirst($request->city),
            'uf' => $request->uf,
            'district' => ucfirst($request->district),
            'street' => ucfirst($request->street),
            'number' => $request->number,
            'sectors' => $request->sectors,
            'photo' => (empty($request->photo)) ? substr($Loja->where('id', $request->id)->get('photo'), 11, 36) : $this->redimensionarImg($request, 'images/loja/', 324, 172)
        ]);
        return redirect('/index')->with('msg', 'Unidade Editada com Sucesso!!');
    }

}
