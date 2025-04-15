<div>
    <x-layouts.app>
        <div class="container mt-5">
            <!-- Título da página com ícone -->
            <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <i class="bi bi-pencil-square text-primary"></i>
                Editar Produto
            </h1>

            <!-- Exibe mensagem de sucesso da sessão, se existir -->
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- Formulário para editar um produto existente -->
            <form wire:submit.prevent="update" enctype="multipart/form-data" class="needs-validation" novalidate>
                <!-- Campo para o nome do produto -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" wire:model.defer="nome"
                        class="form-control @error('nome') is-invalid @enderror" />
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para os ingredientes do produto -->
                <div class="mb-3">
                    <label for="ingredientes" class="form-label">Ingredientes</label>
                    <textarea id="ingredientes" wire:model.defer="ingredientes"
                        class="form-control @error('ingredientes') is-invalid @enderror"></textarea>
                    @error('ingredientes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para o valor do produto -->
                <div class="mb-3">
                    <label for="valor" class="form-label">Valor (R$)</label>
                    <input type="number" step="0.01" id="valor" wire:model.defer="valor"
                        class="form-control @error('valor') is-invalid @enderror" />
                    @error('valor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para upload da nova imagem do produto -->
                <div class="mb-3">
                    <label for="newImagem" class="form-label">Imagem</label>
                    <input type="file" id="newImagem" wire:model="newImagem"
                        class="form-control @error('newImagem') is-invalid @enderror" />
                    @error('newImagem')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <!-- Preview da nova imagem selecionada -->
                    @if ($newImagem)
                        <div class="mt-2">
                            <img src="{{ $newImagem->temporaryUrl() }}" alt="Preview da nova imagem"
                                class="img-thumbnail" style="max-width: 150px;" />
                        </div>
                        <!-- Preview da imagem atual do produto -->
                    @elseif ($imagem)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $imagem) }}" alt="Imagem atual" class="img-thumbnail"
                                style="max-width: 150px;" />
                        </div>
                    @endif
                </div>

                <!-- Botões para atualizar ou cancelar -->
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <a href="{{ route('produtos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
            </form>
        </div>
    </x-layouts.app>
</div>
