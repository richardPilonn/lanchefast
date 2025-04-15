<div>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-8">
            <div class="card shadow">
                <!-- Cabeçalho do card -->
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-center">Detalhes do Cliente</h4>
                </div>
                <div class="card-body">
                    <!-- Exibe o nome do cliente -->
                    <div class="mb-3">
                        <strong>Nome:</strong>
                        <p>{{ $nome }}</p>
                    </div>
                    <!-- Exibe o CPF do cliente -->
                    <div class="mb-3">
                        <strong>CPF:</strong>
                        <p>{{ $cpf }}</p>
                    </div>
                    <!-- Exibe o email do cliente -->
                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p>{{ $email }}</p>
                    </div>
                    <!-- Exibe o telefone do cliente -->
                    <div class="mb-3">
                        <strong>Telefone:</strong>
                        <p>{{ $telefone }}</p>
                    </div>
                    <!-- Exibe o endereço do cliente -->
                    <div class="mb-3">
                        <strong>Endereço:</strong>
                        <p>{{ $endereco }}</p>
                    </div>
                    <!-- Botão para voltar à lista de clientes -->
                    <div class="d-flex justify-content-start mt-4">
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
