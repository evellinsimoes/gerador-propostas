<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposta extends Model
{
        protected $fillable = ['cliente_id', 'titulo', 'desconto', 'validade', 'status', 'observacoes'];
    
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

    // Calcula o valor total da proposta (com desconto)
    public function getTotalAttribute()
    {
        $subtotal = $this->itens->sum(function ($item) {
            return $item->quantidade * $item->valor_unitario;
        });
        return $subtotal - ($subtotal * (($this->desconto ?? 0) / 100));
    }
}
