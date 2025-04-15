<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-3xl font-bold mb-6 flex items-center gap-3">
            <i class="bi bi-person-plus text-green-600"></i>
            Criar Funcionário
        </h1>

        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <form wire:submit.prevent="save" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" wire:model.defer="nome" class="form-control @error('nome') is-invalid @enderror" />
                @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" id="cpf" wire:model.defer="cpf" class="form-control @error('cpf') is-invalid @enderror" />
                @error('cpf') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" />
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" id="senha" wire:model.defer="senha" class="form-control @error('senha') is-invalid @enderror" />
                @error('senha') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>
</x-layouts.app>
