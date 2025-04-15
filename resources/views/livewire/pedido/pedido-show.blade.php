<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-4">Detalhes do Pedido</h1>

        <div class="mb-3">
            <strong>Cliente:</strong> {{ $pedido->cliente->name ?? 'N/A' }}<br>
            <strong>Data e Hora:</strong> {{ $pedido->data_hora_pedido->format('d/m/Y H:i') }}<br>
            <strong>Forma de Pagamento:</strong> {{ $pedido->forma_pagamento }}<br>
            <strong>Status:</strong> {{ $pedido->status }}<br>
            <strong>Valor Desconto:</strong> R$ {{ number_format($pedido->valor_desconto, 2, ',', '.') }}<br>
            <strong>Valor Total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}
        </div>

        <h5>Itens do Pedido</h5>
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedido->itens as $item)
                    <tr>
                        <td>{{ $item->produto->nome ?? 'N/A' }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($item->preco_unitario * $item->quantidade, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</x-layouts.app>
