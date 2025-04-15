<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
            <i class="bi bi-people-fill text-primary"></i>
            Lista de Funcionários
        </h1>

        <input type="text" wire:model="search" placeholder="Buscar funcionários..." class="form-control mb-4" />

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->nome }}</td>
                        <td>{{ $funcionario->cpf }}</td>
                        <td>{{ $funcionario->email }}</td>
                        <td>
                            <a href="{{ route('funcionarios.show', $funcionario->id) }}" class="btn btn-sm btn-info" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button wire:click="delete({{ $funcionario->id }})" class="btn btn-sm btn-danger" title="Deletar" onclick="return confirm('Tem certeza?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted fst-italic">Nenhum funcionário encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $funcionarios->links() }}

        <a href="{{ route('funcionarios.create') }}" class="btn btn-success ms-2 btn-sm mt-3" style="border-radius: 0.25rem; height: 38px; padding-top: 6px; min-width: 140px;">
            <i class="bi bi-plus-lg"></i> Novo Funcionário
        </a>
    </div>
</x-layouts.app>
