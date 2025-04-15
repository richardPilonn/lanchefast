<?php

namespace App\Livewire\Produto;

use App\Models\Produto;
use Livewire\Component;

class ProdutoShow extends Component
{
    // Propriedades públicas que armazenam os dados do produto
    public $produtoId;
    public $nome;
    public $ingredientes;
    public $valor;
    public $imagem;

    // Método chamado ao montar o componente, recebe o produto via route model binding
    public function mount(Produto $produto)
    {
        // Inicializa as propriedades com os dados do produto existente
        $this->produtoId = $produto->id;
        $this->nome = $produto->nome;
        $this->ingredientes = $produto->ingredientes;
        $this->valor = $produto->valor;
        $this->imagem = $produto->imagem;
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.produto.produto-show');
    }
}