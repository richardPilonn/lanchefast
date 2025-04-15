<?php

namespace App\Livewire\Produto;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithFileUploads;

class ProdutoEdit extends Component
{
    use WithFileUploads; // Permite upload de arquivos no Livewire

    // Propriedades públicas que representam os campos do formulário e o ID do produto
    public $produtoId;
    public $nome;
    public $ingredientes;
    public $valor;
    public $imagem; // caminho da imagem atual
    public $newImagem; // nova imagem para upload

    // Regras de validação para os campos do formulário
    protected $rules = [
        'nome' => 'required|string|max:255', // nome obrigatório, texto, máximo 255 caracteres
        'ingredientes' => 'required|string', // ingredientes obrigatórios, texto
        'valor' => 'required|numeric|min:0', // valor obrigatório, numérico, mínimo 0
        'newImagem' => 'nullable|image|max:1024', // nova imagem opcional, deve ser arquivo de imagem, máximo 1MB
    ];

    // Mensagens personalizadas para erros de validação
    protected $messages = [
        'nome.required' => 'O nome do produto é obrigatório.',
        'nome.string' => 'O nome do produto deve ser uma string.',
        'nome.max' => 'O nome do produto não pode ter mais que 255 caracteres.',
        'ingredientes.required' => 'Os ingredientes são obrigatórios.',
        'ingredientes.string' => 'Os ingredientes devem ser um texto válido.',
        'valor.required' => 'O valor é obrigatório.',
        'valor.numeric' => 'O valor deve ser um número.',
        'valor.min' => 'O valor deve ser maior ou igual a zero.',
        'newImagem.image' => 'A imagem deve ser um arquivo de imagem válido.',
        'newImagem.max' => 'A imagem não pode ser maior que 1MB.',
    ];

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

    // Método para atualizar o produto no banco de dados
    public function update()
    {
        // Valida os dados conforme as regras definidas
        $this->validate();

        // Busca o produto no banco pelo ID
        $produto = Produto::findOrFail($this->produtoId);

        // Se uma nova imagem foi enviada, armazena e atualiza o caminho da imagem
        if ($this->newImagem) {
            $imagemPath = $this->newImagem->store('produtos', 'public');
            $produto->imagem = $imagemPath;
        }

        // Atualiza os demais campos do produto
        $produto->nome = $this->nome;
        $produto->ingredientes = $this->ingredientes;
        $produto->valor = $this->valor;
        $produto->save(); // salva as alterações no banco

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Produto atualizado com sucesso.');

        // Redireciona para a página de listagem de produtos
        return redirect()->route('produtos.index');
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.produto.produto-edit');
    }
}