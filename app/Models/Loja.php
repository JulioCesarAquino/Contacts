<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $casts = [
        'sectors' => 'array'
    ];

    public function funcionarios(){
        return $this->hasMany('App\Models\Funcionario');
    }
    
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
