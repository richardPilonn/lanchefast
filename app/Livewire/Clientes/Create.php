<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class Create extends Component
{
    // Propriedades públicas que representam os campos do formulário
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;
    public $senha;

    // Regras de validação para os campos do formulário
    protected $rules = [
        'nome' => 'required|min:3', // nome obrigatório, mínimo 3 caracteres
        'endereco' => 'required', // endereço obrigatório
        'telefone' => 'required', // telefone obrigatório
        'cpf' => 'required|unique:clientes,cpf', // cpf obrigatório e único na tabela clientes
        'email' => 'required|email|unique:clientes,email', // email obrigatório, formato válido e único
        'senha' => 'required|min:6' // senha obrigatória, mínimo 6 caracteres
    ];

    // Método para salvar o cliente no banco de dados
    public function save()
    {
        // Valida os dados conforme as regras definidas
        $this->validate();

        // Cria o cliente no banco com os dados validados, criptografando a senha
        Cliente::create([
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'senha' => bcrypt($this->senha)
        ]);

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Cliente criado com sucesso!');

        // Redireciona para a página de listagem de clientes
        return redirect()->route('clientes.index');
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.clientes.create');
    }
}