<?php

namespace App\Livewire\Produto;

use Livewire\Component;
use App\Models\Produto;
use Livewire\WithFileUploads;

class ProdutoCreate extends Component
{
    use WithFileUploads; // Permite upload de arquivos no Livewire

    // Propriedades públicas que representam os campos do formulário
    public $nome;
    public $ingredientes;
    public $valor;
    public $imagem;

    // Regras de validação para os campos do formulário
    protected $rules = [
        'nome' => 'required|string|max:255', // nome obrigatório, texto, máximo 255 caracteres
        'ingredientes' => 'required|string', // ingredientes obrigatórios, texto
        'valor' => 'required|numeric|min:0', // valor obrigatório, numérico, mínimo 0
        'imagem' => 'nullable|image|max:1024', // imagem opcional, deve ser arquivo de imagem, máximo 1MB
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
        'imagem.image' => 'A imagem deve ser um arquivo de imagem válido.',
        'imagem.max' => 'A imagem não pode ser maior que 1MB.',
    ];

    // Método para salvar o produto no banco de dados
    public function save()
    {
        // Valida os dados conforme as regras definidas
        $this->validate();

        $imagemPath = null;
        // Se uma imagem foi enviada, armazena no disco 'public' dentro da pasta 'produtos'
        if ($this->imagem) {
            $imagemPath = $this->imagem->store('produtos', 'public');
        }

        // Cria o produto no banco com os dados validados
        Produto::create([
            'nome' => $this->nome,
            'ingredientes' => $this->ingredientes,
            'valor' => $this->valor,
            'imagem' => $imagemPath,
        ]);

        // Exibe mensagem de sucesso na sessão
        session()->flash('message', 'Produto criado com sucesso.');

        // Redireciona para a página de listagem de produtos
        return redirect()->route('produtos.index');
    }

    // Renderiza a view do componente
    public function render()
    {
        return view('livewire.produto.produto-create');
    }
}