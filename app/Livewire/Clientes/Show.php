<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class Show extends Component
{
    // Propriedades públicas que armazenam os dados do cliente
    public $clienteId;
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;

    // Método chamado ao montar o componente, recebe o cliente via route model binding
    public function mount(Cliente $cliente)
    {
        // Inicializa as propriedades com os dados do cliente existente
        $this->clienteId = $cliente->id;
        $this->nome = $cliente->nome;
        $this->endereco = $cliente->endereco;
        $this->telefone = $cliente->telefone;
        $this->cpf = $cliente->cpf;
        $this->email = $cliente->email;
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.clientes.show');
    }
}