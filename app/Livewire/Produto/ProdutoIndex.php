<?php

namespace App\Livewire\Produto;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithPagination;

class ProdutoIndex extends Component
{
    use WithPagination; // Trait para paginação automática do Livewire

    // Propriedades públicas para busca e quantidade de itens por página
    public $search = ''; // termo de busca para filtrar produtos
    public $perPage = 10; // quantidade de produtos por página

    // Configura quais propriedades são sincronizadas com a query string da URL
    protected $queryString = [
        'search' => ['except' => ''], // não inclui na URL se vazio
        'perPage' => ['except' => 10], // não inclui na URL se valor padrão
    ];

    // Método que renderiza a view com os dados necessários
    public function render()
    {
        // Busca produtos filtrando por nome ou ingredientes conforme o termo de busca
        $produtos = Produto::where('nome', 'like', "%{$this->search}%")
            ->orWhere('ingredientes', 'like', "%{$this->search}%")
            ->paginate($this->perPage); // paginando resultados

        // Retorna a view com os produtos para exibição
        return view('livewire.produto.produto-index', compact('produtos'));
    }

    // Método para deletar um produto pelo ID
    public function delete($id)
    {
        // Busca o produto pelo ID e deleta, ou falha se não encontrar
        Produto::findOrFail($id)->delete();

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Produto deletado com sucesso.');
    }
}