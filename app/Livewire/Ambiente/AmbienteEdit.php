<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Component;

class AmbienteEdit extends Component
{
    public $id;
    public $nome;
    public $status;
    public $descricao;
    public $ambienteId;

    public function mount($id){
       
        $ambiente = Ambiente::find($id);

        $this->id = $ambiente->id;
        $this->nome = $ambiente->nome;
        $this->status = $ambiente->status;
        $this->descricao = $ambiente->descricao;
    }

    public function update(){
       $ambiente= Ambiente::find($this->id);

       

       $ambiente->nome = $this->nome;
       $ambiente->status = $this->status;
       $ambiente->descricao = $this->descricao;

       $ambiente->save();

       session()->flash('success', 'Atualizado');

       return redirect()->route('ambiente.index');
    }
    public function render()
    {
        return view('livewire.ambiente.ambiente-edit');
    }
}