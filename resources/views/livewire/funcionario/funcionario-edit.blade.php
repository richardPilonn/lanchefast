<x-layouts.app>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Editar Funcionário</h4>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" wire:model="nome" id="nome" class="form-control @error('nome') is-invalid @enderror">
                            @error('nome') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" wire:model="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror">
                            @error('cpf') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha (deixe em branco para não alterar)</label>
                            <input type="password" wire:model="senha" id="senha" class="form-control @error('senha') is-invalid @enderror">
                            @error('senha') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
