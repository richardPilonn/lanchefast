<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_hora_pedido',
        'valor_total',
        'valor_desconto',
        'forma_pagamento',
        'status',
    ];

    protected $casts = [
        'data_hora_pedido' => 'datetime',
    ];

    // Relationship to Cliente (User)
    public function cliente()
    {
        return $this->belongsTo(\App\Models\User::class, 'cliente_id');
    }

    // Relationship to PedidoItem
    public function itens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
