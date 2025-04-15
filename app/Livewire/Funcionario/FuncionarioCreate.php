<?php

namespace App\Livewire\Funcionario;

use Livewire\Component;
use App\Models\Funcionario;

class FuncionarioCreate extends Component
{
    public $nome;
    public $email;
    public $cpf;
    public $senha;

    protected $rules = [
        'nome' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:funcionarios,email',
        'cpf' => 'required|string|unique:funcionarios,cpf',
        'senha' => 'required|string|min:6',
    ];

    protected $messages = [
        'nome.required' => 'O nome é obrigatório.',
        'nome.string' => 'O nome deve ser um texto válido.',
        'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'nome.max' => 'O nome não pode ter mais que 100 caracteres.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Digite um e-mail válido.',
        'email.unique' => 'Este e-mail já está cadastrado.',
        'cpf.required' => 'O CPF é obrigatório.',
        'cpf.string' => 'O CPF deve ser um texto válido.',
        'cpf.unique' => 'Este CPF já está cadastrado.',
        'senha.required' => 'A senha é obrigatória.',
        'senha.string' => 'A senha deve ser um texto válido.',
        'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
    ];

    public function save()
    {
        $this->validate();

        Funcionario::create([
            'nome' => $this->nome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'senha' => bcrypt($this->senha),
        ]);

        session()->flash('message', 'Funcionário criado com sucesso!');
        return redirect()->route('funcionarios.index');
    }

    public function render()
    {
        return view('livewire.funcionario.funcionario-create');
    }
}
