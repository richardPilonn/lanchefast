<?php

namespace App\Livewire\Clientes;

use App\Models\Cliente;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination; // Trait para paginação automática do Livewire

    // Propriedades públicas para busca e quantidade de itens por página
    public $search = ''; // termo de busca para filtrar clientes
    public $perPage = 10; // quantidade de clientes por página

    // Configura quais propriedades são sincronizadas com a query string da URL
    protected $queryString = 
    [
        'search' => ['except' => ''], // não inclui na URL se vazio
        'perPage' => ['except' => 10], // não inclui na URL se valor padrão
    ];

    // Método que renderiza a view com os dados necessários
    public function render()
    {
        // Busca clientes filtrando por nome, email ou cpf conforme o termo de busca
        $clientes = Cliente::where('nome', 'like', "%{$this->search}%")
        ->orWhere('email', 'like',"%{$this->search}%")
        ->orWhere('cpf', 'like', "%{$this->search}%")
        ->paginate($this->perPage); // paginando resultados

        // Retorna a view com os clientes para exibição
        return view('livewire.clientes.index', compact('clientes'));
    }

    // Método para deletar um cliente pelo ID
    public function delete($id)
    {
        // Busca o cliente pelo ID e deleta, ou falha se não encontrar
        Cliente::findOrFail($id)->delete();

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Cliente deletado com sucesso.');
    }
}