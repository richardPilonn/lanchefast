<div>
    <x-layouts.app>
        <div class="container mt-5">
            <!-- Título da página com ícone -->
            <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <i class="bi bi-box-seam text-green-600"></i>
                Lista de Produtos
            </h1>

            <!-- Campo de busca que atualiza a propriedade 'search' do componente Livewire -->
            <input type="text" wire:model="search" placeholder="Buscar produtos..." class="form-control mb-4" />

            <!-- Exibe mensagem de sucesso da sessão, se existir -->
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- Tabela com a listagem dos produtos -->
            <table class="table table-striped table-hover align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Nome</th>
                        <th>Ingredientes</th>
                        <th>Valor</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop para exibir cada produto -->
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->ingredientes }}</td>
                            <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                            <td>
                                <!-- Exibe a imagem do produto, se existir -->
                                @if ($produto->imagem)
                                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                                        class="img-thumbnail" style="max-width: 60px;" />
                                @else
                                    <span class="text-muted fst-italic">Sem imagem</span>
                                @endif
                            </td>
                            <td>
                                <!-- Botão para ver detalhes do produto -->
                                <a href="{{ route('produtos.show', $produto->id) }}"
                                    class="btn btn-sm btn-outline-success" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <!-- Botão para editar o produto -->
                                <a href="{{ route('produtos.edit', $produto->id) }}"
                                    class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <!-- Botão para deletar o produto, com confirmação -->
                                <button wire:click="delete({{ $produto->id }})" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Tem certeza?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Links de paginação -->
            {{ $produtos->links() }}

            <!-- Botão para criar um novo produto -->
            <a href="{{ route('produtos.create') }}" class="btn btn-success mt-3">Criar Novo Produto</a>
        </div>
    </x-layouts.app>
</div>
