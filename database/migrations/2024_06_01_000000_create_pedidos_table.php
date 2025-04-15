<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->unsigned('clientes')->onDelete('cascade');
            $table->dateTime('data_hora_pedido');
            $table->decimal('valor_total', 10, 2);
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->enum('forma_pagamento', ['Cartão de Crédito', 'Débito', 'Pix', 'Dinheiro']);
            $table->enum('status', ['Em Aberto', 'Aguardando Preparo', 'Em Preparo', 'Em Rota de Entrega', 'Entregue'])->default('Em Aberto');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
