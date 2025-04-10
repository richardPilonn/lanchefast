<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;

class Create extends Component
{
    public $nome;
    public $endereco;
    public $telefone;
    public $cpf;
    public $email;
    public $senha;

    protected $rules = [
        'nome' => 'required|min:3',
        'endereco' => 'required',
        'telefone' => 'required',
        'cpf' => 'required|unique:clientes,cpf',
        'email' => 'required|email|unique:clientes,email',
        'senha' => 'required|min:6'
    ];

    public function save()
    {
        $this->validate();

        Cliente::create([
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
            'email' => $this->email,
            'senha' => bcrypt($this->senha)
        ]);

        session()->flash('message', 'Cliente criado com sucesso!');
        return redirect()->route('clientes.index');
    }

    public function render()
    {
        return view('livewire.clientes.create');
    }
}
