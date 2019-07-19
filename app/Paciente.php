<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['cliente_id','nome','anoNascimento'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
