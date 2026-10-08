<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Editar ambiente')]
class AmbienteEdit extends Component
{
    public Ambiente $ambiente;

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

    public function mount(Ambiente $ambiente): void
    {
        $this->ambiente = $ambiente;
        $this->nome = $ambiente->nome;
        $this->descricao = (string) $ambiente->descricao;
        $this->status = (bool) $ambiente->status;
    }

    public function salvar()
    {
        $this->ambiente->update($this->validate());

        session()->flash('sucesso', 'Ambiente atualizado com sucesso.');

        return $this->redirectRoute('ambientes.index');
    }

    public function render()
    {
        return view('livewire.ambiente.ambiente-edit');
    }
}
