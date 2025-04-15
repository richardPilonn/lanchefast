<x-layouts.app>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-3xl font-bold">
                <i class="bi bi-people-fill text-primary"></i> Clientes
            </h1>
        </div>

        <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <input type="text" wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar clientes...">
            </div>
            <div class="col-md-3 d-flex align-items-center gap-2">
                <select wire:model="perPage" class="form-select">
                    <option value="10">10 por página</option>
                    <option value="25">25 por página</option>
                    <option value="50">50 por página</option>
                    <option value="100">100 por página</option>
                </select>
                <a href="{{ route('clientes.create') }}" class="btn btn-success ms-2 btn-sm" style="border-radius: 0.25rem; height: 38px; padding-top: 6px; min-width: 140px;">
                    <i class="bi bi-plus-lg"></i> Novo Cliente
                </a>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->cpf }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefone }}</td>
                            <td class="text-center">
                                <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button wire:click="delete({{ $cliente->id }})" class="btn btn-sm btn-danger" title="Deletar" onclick="return confirm('Tem certeza?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted fst-italic">Nenhum cliente encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $clientes->links() }}
        </div>
    </div>
</x-layouts.app>