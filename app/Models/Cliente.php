<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome', 'email', 'telefone'];

    // Um cliente tem MUITAS propostas
    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }
}
