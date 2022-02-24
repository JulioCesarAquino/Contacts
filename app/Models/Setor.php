<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    public function funcionarios(){
        return $this->hasMany('App\Models\Funcionario');
    }
}