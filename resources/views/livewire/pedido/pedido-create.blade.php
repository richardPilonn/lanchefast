<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-4">Criar Pedido</h1>

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar produtos pelo nome..." class="form-control" />
        </div>

        <div class="row">
            <div class="col-md-6">
                <h5>Produtos Disponíveis</h5>
                <ul class="list-group mb-3" style="max-height: 300px; overflow-y: auto;">
                    @foreach ($produtos as $produto)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $produto->nome }}</strong><br>
                                <small>R$ {{ number_format($produto->valor, 2, ',', '.') }}</small>
                            </div>
                            <button wire:click="addProduto({{ $produto->id }})" class="btn btn-sm btn-primary">Adicionar</button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <h5>Produtos Selecionados</h5>
                @if (count($selectedProdutos) > 0)
                    <ul class="list-group mb-3">
                        @foreach ($selectedProdutos as $produtoId)
                            @php
                                $produto = $produtos->firstWhere('id', $produtoId) ?? \App\Models\Produto::find($produtoId);
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $produto->nome }}</strong><br>
                                    <small>R$ {{ number_format($produto->valor, 2, ',', '.') }}</small>
                                </div>
                                <input type="number" min="1" wire:model.lazy="quantidades.{{ $produtoId }}" class="form-control form-control-sm w-25 me-2" />
                                <button wire:click="removeProduto({{ $produtoId }})" class="btn btn-sm btn-danger">Remover</button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted fst-italic">Nenhum produto selecionado.</p>
                @endif

                <div class="mb-3">
                    <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                    <select wire:model="forma_pagamento" id="forma_pagamento" class="form-select">
                        <option>Cartão de Crédito</option>
                        <option>Débito</option>
                        <option>Pix</option>
                        <option>Dinheiro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="valor_desconto" class="form-label">Valor de Desconto (R$)</label>
                    <input type="number" wire:model.lazy="valor_desconto" id="valor_desconto" class="form-control" min="0" step="0.01" />
                </div>

                <div class="mb-3">
                    <strong>Total: R$ {{ number_format($this->valorTotal - $this->valor_desconto, 2, ',', '.') }}</strong>
                </div>

                <button wire:click="save" class="btn btn-success">Salvar Pedido</button>
            </div>
        </div>
    </div>
</x-layouts.app>
