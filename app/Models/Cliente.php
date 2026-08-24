<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    // Um cliente tem MUITAS propostas
    public function propostas()
    {
        return $this->hasMany(Proposta::class);
    }
}
