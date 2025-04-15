<?php

namespace App\Livewire\Pedido;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Pedido::query()->with(['cliente', 'itens.produto']);

        // Se o usuário for cliente, mostrar apenas seus pedidos
        if (Auth::check() && Auth::user()->role === 'cliente') {
            $query->where('cliente_id', Auth::id());
        }

        // Buscar pelo nome do produto nos itens do pedido
        if ($this->search) {
            $query->whereHas('itens.produto', function ($q) {
                $q->where('nome', 'like', '%' . $this->search . '%');
            });
        }

        $pedidos = $query->orderBy('data_hora_pedido', 'desc')->paginate(10);

        return view('livewire.pedido.pedido-index', compact('pedidos'));
    }
}
