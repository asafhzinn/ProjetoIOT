<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Novo ambiente')]
class AmbienteCreate extends Component
{
    public string $nome = '';

    public string $descricao = '';

    public bool $status = true;

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'boolean',
        ];
    }

    protected $validationAttributes = [
        'descricao' => 'descrição',
    ];

    public function salvar()
    {
        Ambiente::create($this->validate());

        session()->flash('sucesso', 'Ambiente cadastrado com sucesso.');

        return $this->redirectRoute('ambientes.index');
    }

    public function render()
    {
        return view('livewire.ambiente.ambiente-create');
    }
}
