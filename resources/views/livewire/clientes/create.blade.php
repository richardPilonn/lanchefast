<div>


    <x-layouts.app>
        <div class="container mt-5">
            <!-- Título da página com ícone -->
            <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <i class="bi bi-plus-circle text-green-600"></i>
                Criar Cliente
            </h1>

            <!-- Exibe mensagem de sucesso da sessão, se existir -->
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <!-- Formulário para criar um novo cliente -->
            <form wire:submit.prevent="save" class="needs-validation" novalidate>
                <!-- Campo para o nome do cliente -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" id="nome" wire:model.defer="nome"
                        class="form-control @error('nome') is-invalid @enderror" />
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para o endereço do cliente -->
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" id="endereco" wire:model.defer="endereco"
                        class="form-control @error('endereco') is-invalid @enderror" />
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para o telefone do cliente -->
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" id="telefone" wire:model.defer="telefone"
                        class="form-control @error('telefone') is-invalid @enderror" />
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para o CPF do cliente -->
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" id="cpf" wire:model.defer="cpf"
                        class="form-control @error('cpf') is-invalid @enderror" />
                    @error('cpf')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para o email do cliente -->
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" wire:model.defer="email"
                        class="form-control @error('email') is-invalid @enderror" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Campo para a senha do cliente -->
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" id="senha" wire:model.defer="senha"
                        class="form-control @error('senha') is-invalid @enderror" />
                    @error('senha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botões para salvar ou cancelar -->
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
            </form>
        </div>
    </x-layouts.app>
</div>
