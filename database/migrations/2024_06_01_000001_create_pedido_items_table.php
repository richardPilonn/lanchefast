<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoItemsTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->unsigned('pedidos')->onDelete('cascade');
            $table->foreignId('produto_id')->unsigned('produtos')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();
            $table->unique(['pedido_id', 'produto_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido_items');
    }
}
