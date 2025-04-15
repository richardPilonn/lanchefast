<?php

namespace App\Livewire\Funcionario;

use Livewire\Component;
use App\Models\Funcionario;

class FuncionarioShow extends Component
{
    public $funcionarioId;
    public $nome;
    public $email;
    public $cpf;

    public function mount(Funcionario $funcionario)
    {
        $this->funcionarioId = $funcionario->id;
        $this->nome = $funcionario->nome;
        $this->email = $funcionario->email;
        $this->cpf = $funcionario->cpf;
    }

    public function render()
    {
        return view('livewire.funcionario.funcionario-show');
    }
}
