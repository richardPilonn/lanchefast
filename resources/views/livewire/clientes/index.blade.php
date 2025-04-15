<div>
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <!-- Título da página -->
                <h2>Clientes</h2>
            </div>
            <div class="col-md-6 text-end">
                <!-- Botão para criar um novo cliente -->
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Novo Cliente
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <!-- Campo de busca com debounce para atualizar a propriedade 'search' -->
                        <input type="text" wire:model.debounce.300ms="search" class="form-control"
                            placeholder="Buscar Clientes...">
                    </div>
                    <div class="col-md-3">
                        <!-- Select para escolher a quantidade de itens por página -->
                        <select wire:model="perPage" class="form-select">
                            <option value="10">10 por página</option>
                            <option value="25">25 por página</option>
                            <option value="50">50 por página</option>
                            <option value="100">100 por página</option>
                        </select>
                    </div>
                </div>
                <!-- Exibe mensagem de sucesso da sessão, se existir -->
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <!-- Tabela com a listagem dos clientes -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop para exibir cada cliente -->
                            @forelse($clientes as $cliente)
                                <tr>
                                    <td>{{ $cliente->nome }}</td>
                                    <td>{{ $cliente->cpf }}</td>
                                    <td>{{ $cliente->email }}</td>
                                    <td>{{ $cliente->telefone }}</td>
                                    <td>
                                        <!-- Botão para ver detalhes do cliente -->
                                        <a href="{{ route('clientes.show', $cliente->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <!-- Botão para editar o cliente -->
                                        <a href="{{ route('clientes.edit', $cliente->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <!-- Botão para deletar o cliente, com confirmação -->
                                        <button wire:click="delete({{ $cliente->id }})" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tem certeza?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum Cliente encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Links de paginação -->
                <div class="mt-3">
                    {{ $clientes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>