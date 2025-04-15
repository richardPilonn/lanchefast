<?php

use App\Livewire\Funcionario\FuncionarioCreate;
use App\Livewire\Funcionario\FuncionarioEdit;
use App\Livewire\Funcionario\FuncionarioIndex;
use App\Livewire\Funcionario\FuncionarioShow;
use App\Livewire\Produto\ProdutoCreate;
use App\Livewire\Produto\ProdutoEdit;
use App\Livewire\Produto\ProdutoIndex;
use App\Livewire\Produto\ProdutoShow;
use Illuminate\Support\Facades\Route;


Route::prefix('clientes')->group(function () {
    Route::get('/', \App\Livewire\Clientes\Index::class)->name('clientes.index');
    Route::get('/create', \App\Livewire\Clientes\Create::class)->name('clientes.create');
    Route::get('/{cliente}', \App\Livewire\Clientes\Show::class)->name('clientes.show');
    Route::get('/{cliente}/edit', \App\Livewire\Clientes\Edit::class)->name('clientes.edit');
});

Route::prefix('produtos')->group(function () {
    Route::get('/', ProdutoIndex::class)->name('produtos.index');
    Route::get('/create', ProdutoCreate::class)->name('produtos.create');
    Route::get('/{produto}', ProdutoShow::class)->name('produtos.show');
    Route::get('/{produto}/edit', ProdutoEdit::class)->name('produtos.edit');
});

Route::prefix('funcionarios')->group(function () {
    Route::get('/', FuncionarioIndex::class)->name('funcionarios.index');
    Route::get('/create', FuncionarioCreate::class)->name('funcionarios.create');
    Route::get('/{funcionario}', FuncionarioShow::class)->name('funcionarios.show');
    Route::get('/{funcionario}/edit', FuncionarioEdit::class)->name('funcionarios.edit');
});

use App\Livewire\Pedido\PedidoIndex;
use App\Livewire\Pedido\PedidoCreate;
use App\Livewire\Pedido\PedidoShow;
use App\Livewire\Pedido\PedidoEdit;

Route::prefix('pedidos')->group(function () {
    Route::get('/', PedidoIndex::class)->name('pedidos.index');
    Route::get('/create', PedidoCreate::class)->name('pedidos.create');
    Route::get('/{pedido}', PedidoShow::class)->name('pedidos.show');
    Route::get('/{pedido}/edit', PedidoEdit::class)->name('pedidos.edit');
});
