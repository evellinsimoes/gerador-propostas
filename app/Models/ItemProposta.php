<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemProposta extends Model
{
    // Um item pertence a UMA proposta
    public function proposta()
    {
        return $this->belongsTo(Proposta::class);
    }
}
