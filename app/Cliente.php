<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome','telefone'];

    public function paciente()
    {
        return $this->hasMany('App\Paciente');
    }
    
}
