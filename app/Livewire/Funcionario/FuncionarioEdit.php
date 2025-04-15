<?php

namespace App\Livewire\Funcionario;

use Livewire\Component;
use App\Models\Funcionario;

class FuncionarioEdit extends Component
{
    public $funcionario;

    public $nome;
    public $email;
    public $cpf;
    public $senha;

    public function rules()
    {
        return [
            'nome' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:funcionarios,email,' . $this->funcionario->id,
            'cpf' => 'required|string|unique:funcionarios,cpf,' . $this->funcionario->id,
            'senha' => 'nullable|string|min:6',
        ];
    }

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
        'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
    ];

    public function mount(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
        $this->nome = $funcionario->nome;
        $this->email = $funcionario->email;
        $this->cpf = $funcionario->cpf;
        $this->senha = null;
    }

    public function update()
    {
        $this->validate();

        $this->funcionario->nome = $this->nome;
        $this->funcionario->email = $this->email;
        $this->funcionario->cpf = $this->cpf;
        if ($this->senha) {
            $this->funcionario->senha = bcrypt($this->senha);
        }
        $this->funcionario->save();

        session()->flash('message', 'Funcionário atualizado com sucesso!');
        return redirect()->route('funcionarios.index');
    }

    public function render()
    {
        return view('livewire.funcionario.funcionario-edit');
    }
}
