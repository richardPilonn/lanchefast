<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-4">Pedidos</h1>

        <div class="mb-3">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar por nome do produto..." class="form-control" />
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Data e Hora</th>
                    <th>Cliente</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->data_hora_pedido->format('d/m/Y H:i') }}</td>
                        <td>{{ $pedido->cliente->name ?? 'N/A' }}</td>
                        <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                        <td>{{ $pedido->status }}</td>
                        <td>
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted fst-italic">Nenhum pedido encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            {{ $pedidos->links() }}
        </div>
    </div>
</x-layouts.app>
