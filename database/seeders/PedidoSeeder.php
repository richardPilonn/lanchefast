<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PedidoSeeder extends Seeder
{
    public function run()
    {
        // Obter alguns clientes para associar os pedidos
        $clientes = User::where('role', 'cliente')->get();

        // Obter produtos para adicionar aos pedidos
        $produtos = Produto::all();

        if ($clientes->isEmpty() || $produtos->isEmpty()) {
            $this->command->info('Não há clientes ou produtos suficientes para criar pedidos.');
            return;
        }

        foreach ($clientes as $cliente) {
            // Criar entre 1 e 3 pedidos por cliente
            $numPedidos = rand(1, 3);

            for ($i = 0; $i < $numPedidos; $i++) {
                DB::beginTransaction();

                try {
                    $pedido = Pedido::create([
                        'cliente_id' => $cliente->id,
                        'data_hora_pedido' => now()->subDays(rand(0, 30))->subMinutes(rand(0, 1440)),
                        'valor_total' => 0,
                        'valor_desconto' => 0,
                        'forma_pagamento' => ['Cartão de Crédito', 'Débito', 'Pix', 'Dinheiro'][array_rand(['Cartão de Crédito', 'Débito', 'Pix', 'Dinheiro'])],
                        'status' => ['Em Aberto', 'Aguardando Preparo', 'Em Preparo', 'Em Rota de Entrega', 'Entregue'][array_rand(['Em Aberto', 'Aguardando Preparo', 'Em Preparo', 'Em Rota de Entrega', 'Entregue'])],
                    ]);

                    $total = 0;

                    // Adicionar entre 1 e 5 itens ao pedido
                    $numItens = rand(1, 5);
                    $produtosSelecionados = $produtos->random($numItens);

                    foreach ($produtosSelecionados as $produto) {
                        $quantidade = rand(1, 3);
                        $precoUnitario = $produto->valor;

                        PedidoItem::create([
                            'pedido_id' => $pedido->id,
                            'produto_id' => $produto->id,
                            'quantidade' => $quantidade,
                            'preco_unitario' => $precoUnitario,
                        ]);

                        $total += $precoUnitario * $quantidade;
                    }

                    // Atualizar valor total do pedido
                    $pedido->valor_total = $total;
                    $pedido->save();

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $this->command->error('Erro ao criar pedido: ' . $e->getMessage());
                }
            }
        }
    }
}
