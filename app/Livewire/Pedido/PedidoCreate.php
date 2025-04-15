<?php

namespace App\Livewire\Pedido;

use Livewire\Component;
use App\Models\Produto;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoCreate extends Component
{
    public $search = '';
    public $produtos = [];
    public $selectedProdutos = [];
    public $quantidades = [];
    public $forma_pagamento = 'Cartão de Crédito';
    public $valor_desconto = 0;

    public function mount()
    {
        $this->loadProdutos();
    }

    public function updatedSearch()
    {
        $this->loadProdutos();
    }

    public function loadProdutos()
    {
        $this->produtos = Produto::where('nome', 'like', '%' . $this->search . '%')->get();
    }

    public function addProduto($produtoId)
    {
        if (!in_array($produtoId, $this->selectedProdutos)) {
            $this->selectedProdutos[] = $produtoId;
            $this->quantidades[$produtoId] = 1;
        }
    }

    public function removeProduto($produtoId)
    {
        if (($key = array_search($produtoId, $this->selectedProdutos)) !== false) {
            unset($this->selectedProdutos[$key]);
            unset($this->quantidades[$produtoId]);
            $this->selectedProdutos = array_values($this->selectedProdutos);
        }
    }

    public function updatedQuantidades($value, $key)
    {
        if ($value < 1) {
            $this->quantidades[$key] = 1;
        }
    }

    public function getValorTotalProperty()
    {
        $total = 0;
        foreach ($this->selectedProdutos as $produtoId) {
            $produto = Produto::find($produtoId);
            if ($produto) {
                $total += $produto->valor * ($this->quantidades[$produtoId] ?? 1);
            }
        }
        return $total;
    }

    public function save()
    {
        $this->validate([
            'forma_pagamento' => 'required|in:Cartão de Crédito,Débito,Pix,Dinheiro',
            'selectedProdutos' => 'required|array|min:1',
        ]);

        DB::beginTransaction();

        try {
            $pedido = Pedido::create([
                'cliente_id' => Auth::id(),
                'data_hora_pedido' => now(),
                'valor_total' => $this->valorTotal,
                'valor_desconto' => $this->valor_desconto,
                'forma_pagamento' => $this->forma_pagamento,
                'status' => 'Em Aberto',
            ]);

            foreach ($this->selectedProdutos as $produtoId) {
                $produto = Produto::find($produtoId);
                if ($produto) {
                    PedidoItem::create([
                        'pedido_id' => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $this->quantidades[$produtoId] ?? 1,
                        'preco_unitario' => $produto->valor,
                    ]);
                }
            }

            DB::commit();

            session()->flash('message', 'Pedido criado com sucesso!');
            return redirect()->route('pedidos.index');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erro ao criar pedido: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pedido.pedido-create');
    }
}
