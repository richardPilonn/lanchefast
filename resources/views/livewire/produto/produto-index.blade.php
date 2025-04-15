<div>
    <!-- Início do layout da página, que está utilizando um componente de layout personalizado chamado 'x-layouts.app' -->
    <x-layouts.app>
        <div class="container mt-5">
            <!-- Seção com título e botão para criar um novo produto -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Título da página, com ícone e texto -->
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    <i class="bi bi-box-seam text-green-600"></i> <!-- Ícone de caixa -->
                    Lista de Produtos <!-- Título -->
                </h1>
                <!-- Botão para criar um novo produto, com ícone de adição -->
                    <a href="{{ route('produtos.create') }}" class="btn btn-success ms-2 btn-sm" style="border-radius: 0.25rem; height: 38px; padding-top: 6px; min-width: 140px;">
                        <i class="bi bi-plus-lg"></i> Criar Novo Produto <!-- Ícone e texto do botão -->
                    </a>
                </div>

            <!-- Campo de busca para filtrar produtos, vinculando ao Livewire para pesquisa dinâmica -->
            <input type="text" wire:model="search" placeholder="Buscar produtos..." class="form-control mb-4" />
            
            <!-- Exibe uma mensagem de sucesso quando a sessão contém uma mensagem -->
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div> <!-- Mensagem de sucesso -->
            @endif

            <!-- Tabela para exibir a lista de produtos -->
            <table class="table table-striped table-hover align-middle">
                <!-- Cabeçalho da tabela -->
                <thead class="table-success">
                    <tr>
                        <!-- Definição das colunas da tabela -->
                        <th>Nome</th>
                        <th>Ingredientes</th>
                        <th>Valor</th>
                        <th>Imagem</th>
                        <th>Ações</th> <!-- Coluna para ações como editar e deletar -->
                    </tr>
                </thead>
                <!-- Corpo da tabela, onde os produtos são exibidos -->
                <tbody>
                    <!-- Loop para exibir cada produto da coleção 'produtos' -->
                    @foreach ($produtos as $produto)
                        <tr>
                            <!-- Exibe as informações de cada produto -->
                            <td>{{ $produto->nome }}</td> <!-- Nome do produto -->
                            <td>{{ $produto->ingredientes }}</td> <!-- Ingredientes do produto -->
                            <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td> <!-- Valor do produto com formatação monetária -->
                            <td>
                                <!-- Exibe a imagem do produto, se existir, caso contrário exibe 'Sem imagem' -->
                                @if ($produto->imagem)
                                    <img src="{{ asset('storage/' . $produto->imagem) }}" alt="{{ $produto->nome }}"
                                        class="img-thumbnail" style="max-width: 60px;" /> <!-- Exibe a imagem do produto -->
                                @else
                                    <span class="text-muted fst-italic">Sem imagem</span> <!-- Caso não haja imagem -->
                                @endif
                            </td>
                            <td>
                                <!-- Botão para visualizar detalhes do produto -->
                                <a href="{{ route('produtos.show', $produto->id) }}" class="btn btn-sm btn-info" title="Ver">
                                    <i class="bi bi-eye"></i> <!-- Ícone de olho -->
                                </a>
                                <!-- Botão para editar o produto -->
                                <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="bi bi-pencil"></i> <!-- Ícone de lápis -->
                                </a>
                                <!-- Botão para deletar o produto com confirmação -->
                                <button wire:click="delete({{ $produto->id }})" class="btn btn-sm btn-danger" title="Deletar" onclick="return confirm('Tem certeza?')">
                                    <i class="bi bi-trash"></i> <!-- Ícone de lixeira -->
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Links de paginação gerados pelo método 'paginate' do Laravel -->
            {{ $produtos->links() }} <!-- Exibe os links para navegar entre as páginas de produtos -->
        </div>
    </x-layouts.app> <!-- Fim do layout da página -->
</div>
