<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    public function index(){
        return view('setor.list');

    }

    public function create(){
        return view('setor.create');
    }

    public function store(Request $Request){
        $setor = New Setor;
        $setor->name = ucfirst($Request->name);
        $setor->save();
        $setors = Setor::all();
        return view('loja.create',['setors' => $setors])->with("Setor Cadastrado com Sucesso!!!");
       
    }
}
