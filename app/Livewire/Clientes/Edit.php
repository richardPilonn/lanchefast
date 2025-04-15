<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class Edit extends Component
{
    public $cliente;  // O Laravel passa o cliente completo para o componente

    // Propriedades públicas que representam os campos do formulário
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;
    public $senha;

    // Regras de validação para os campos do formulário
    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:100', // nome obrigatório, texto, entre 3 e 100 caracteres
            'endereco' => 'required|string|max:255', // endereço obrigatório, texto, máximo 255 caracteres
            'telefone' => 'required|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/', // telefone obrigatório, formato regex válido
            'cpf' => 'required|unique:clientes,cpf,' . $this->cliente->id, // cpf obrigatório e único, exceto o atual
            'email' => 'required|email|unique:clientes,email,' . $this->cliente->id, // email obrigatório, válido e único, exceto o atual
            'senha' => 'nullable|min:6', // senha opcional, mínimo 6 caracteres
        ];
    }

    // Mensagens personalizadas para erros de validação
    protected $messages = [
        'nome.required' => 'O nome é obrigatório',
        'nome.min' => 'O nome deve ter pelo menos 3 caracteres',
        'endereco.required' => 'O endereço é obrigatório',
        'telefone.required' => 'O telefone é obrigatório',
        'telefone.regex' => 'Formato de telefone inválido',
        'cpf.required' => 'O CPF é obrigatório',
        'cpf.unique' => 'Este CPF já está cadastrado',
        'email.required' => 'O e-mail é obrigatório',
        'email.email' => 'Digite um e-mail válido',
        'email.unique' => 'Este e-mail já está cadastrado',
        'senha.min' => 'A senha deve ter pelo menos 6 caracteres',
    ];

    // Método chamado ao montar o componente, recebe o cliente via route model binding
    public function mount(Cliente $cliente)
    {
        // Inicializa as propriedades com os dados do cliente existente
        $this->cliente = $cliente;
        $this->nome = $cliente->nome;
        $this->endereco = $cliente->endereco;
        $this->telefone = $cliente->telefone;
        $this->cpf = $cliente->cpf;
        $this->email = $cliente->email;
        $this->senha = null; // senha não é preenchida por segurança
    }

    // Método para atualizar o cliente no banco de dados
    public function update()
    {
        // Valida os dados conforme as regras definidas
        $this->validate();

        // Atualiza os campos do cliente
        $this->cliente->nome = $this->nome;
        $this->cliente->endereco = $this->endereco;
        $this->cliente->telefone = $this->telefone;
        $this->cliente->cpf = $this->cpf;
        $this->cliente->email = $this->email;
        if ($this->senha) {
            // Se a senha foi preenchida, criptografa e atualiza
            $this->cliente->senha = bcrypt($this->senha);
        }
        $this->cliente->save(); // salva as alterações no banco

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Cliente atualizado com sucesso!');

        // Redireciona para a página de listagem de clientes
        return redirect()->route('clientes.index');
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.clientes.edit');
    }
}