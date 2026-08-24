<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
    // Uma proposta pertence a UM cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Uma proposta tem MUITOS itens
    public function itens()
    {
        return $this->hasMany(ItemProposta::class);
    }
}
