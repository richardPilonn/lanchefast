<div>
    <x-layouts.app>
        <div class="container mt-5">
            <!-- Título da página com ícone -->
            <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <i class="bi bi-eye text-info"></i>
                Detalhes do Produto
            </h1>

            <!-- Card para exibir os detalhes do produto -->
            <div class="card">
                <div class="card-body">
                    <!-- Nome do produto -->
                    <h2 class="card-title">{{ $nome }}</h2>
                    <!-- Ingredientes do produto -->
                    <p><strong>Ingredientes:</strong> {{ $ingredientes }}</p>
                    <!-- Valor do produto formatado -->
                    <p><strong>Valor:</strong> R$ {{ number_format($valor, 2, ',', '.') }}</p>
                    <!-- Imagem do produto, se existir -->
                    <div>
                        @if ($imagem)
                            <img src="{{ asset('storage/' . $imagem) }}" alt="{{ $nome }}" class="img-thumbnail"
                                style="max-width: 200px;" />
                        @else
                            <span class="text-muted fst-italic">Sem imagem</span>
                        @endif
                    </div>
                    <!-- Botões para voltar à lista e editar o produto -->
                    <a href="{{ route('produtos.index') }}" class="btn btn-secondary mt-3">Voltar</a>
                    <a href="{{ route('produtos.edit', $produtoId) }}" class="btn btn-primary mt-3 ms-2">Editar</a>
                </div>
            </div>
        </div>
    </x-layouts.app>
</div>
