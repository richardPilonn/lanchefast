<?php

namespace App\Livewire\Pedido;

use Livewire\Component;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\DB;

class PedidoEdit extends Component
{
    public $pedido;
    public $status;
    public $forma_pagamento;
    public $selectedProdutos = [];
    public $quantidades = [];

    public function mount($pedidoId)
    {
        $this->pedido = Pedido::with('itens')->findOrFail($pedidoId);
        $this->status = $this->pedido->status;
        $this->forma_pagamento = $this->pedido->forma_pagamento;

        foreach ($this->pedido->itens as $item) {
            $this->selectedProdutos[] = $item->produto_id;
            $this->quantidades[$item->produto_id] = $item->quantidade;
        }
    }

    public function updatedQuantidades($value, $key)
    {
        if ($value < 1) {
            $this->quantidades[$key] = 1;
        }
    }

    public function save()
    {
        $this->validate([
            'status' => 'required|in:Em Aberto,Aguardando Preparo,Em Preparo,Em Rota de Entrega,Entregue',
            'forma_pagamento' => 'required|in:Cartão de Crédito,Débito,Pix,Dinheiro',
            'selectedProdutos' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            $this->pedido->update([
                'status' => $this->status,
                'forma_pagamento' => $this->forma_pagamento,
            ]);

            // Delete removed items
            $currentProdutoIds = $this->pedido->itens->pluck('produto_id')->toArray();
            $toDelete = array_diff($currentProdutoIds, $this->selectedProdutos);
            PedidoItem::where('pedido_id', $this->pedido->id)->whereIn('produto_id', $toDelete)->delete();

            // Update or create items
            foreach ($this->selectedProdutos as $produtoId) {
                $produto = Produto::find($produtoId);
                if ($produto) {
                    PedidoItem::updateOrCreate(
                        ['pedido_id' => $this->pedido->id, 'produto_id' => $produtoId],
                        ['quantidade' => $this->quantidades[$produtoId] ?? 1, 'preco_unitario' => $produto->valor]
                    );
                }
            }

            DB::commit();

            session()->flash('message', 'Pedido atualizado com sucesso!');
            return redirect()->route('pedidos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erro ao atualizar pedido: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pedido.pedido-edit');
    }
}
