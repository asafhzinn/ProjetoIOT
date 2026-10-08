<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Component;

class AmbienteCreate extends Component
{
    public $nome = '';
    public $descricao = '';
    public $status = true;

    public function store()
    {
        $dados = $this->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Ambiente::create($dados);
        session()->flash('success', 'Ambiente cadastrado com sucesso!');
        return redirect()->route('ambiente.index');
    }

    public function render()
    {
        return view('livewire.ambiente.ambiente-create');
    }
}