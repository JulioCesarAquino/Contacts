<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    public function loja(){
        return $this->belongsTo('App\Models\Loja');
    }
    
    public function setor(){
        return $this->belongsTo('App\Models\Setor');
    }
    
}
