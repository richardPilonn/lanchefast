<?php

namespace App\Livewire\Pedido;

use Livewire\Component;
use App\Models\Pedido;

class PedidoShow extends Component
{
    public $pedido;

    public function mount($pedidoId)
    {
        $this->pedido = Pedido::with(['cliente', 'itens.produto'])->findOrFail($pedidoId);
    }

    public function render()
    {
        return view('livewire.pedido.pedido-show', [
            'pedido' => $this->pedido,
        ]);
    }
}
