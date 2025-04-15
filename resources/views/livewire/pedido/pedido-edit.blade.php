<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-4">Editar Pedido</h1>

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="save">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select wire:model="status" id="status" class="form-select">
                    <option>Em Aberto</option>
                    <option>Aguardando Preparo</option>
                    <option>Em Preparo</option>
                    <option>Em Rota de Entrega</option>
                    <option>Entregue</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                <select wire:model="forma_pagamento" id="forma_pagamento" class="form-select">
                    <option>Cartão de Crédito</option>
                    <option>Débito</option>
                    <option>Pix</option>
                    <option>Dinheiro</option>
                </select>
            </div>

            <h5>Itens do Pedido</h5>
            @if (count($selectedProdutos) > 0)
                <ul class="list-group mb-3">
                    @foreach ($selectedProdutos as $produtoId)
                        @php
                            $produto = \App\Models\Produto::find($produtoId);
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $produto->nome }}</strong><br>
                                <small>R$ {{ number_format($produto->valor, 2, ',', '.') }}</small>
                            </div>
                            <input type="number" min="1" wire:model.lazy="quantidades.{{ $produtoId }}" class="form-control form-control-sm w-25 me-2" />
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-muted fst-italic">Nenhum produto selecionado.</p>
            @endif

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
