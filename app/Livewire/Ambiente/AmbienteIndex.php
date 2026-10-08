<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Component;

class AmbienteIndex extends Component
{
    public $search='';

    public function delete($id){
        $ambiente = Ambiente::find($id);

        if($ambiente != null){
            $ambiente->delete();
            session()->flash('success', 'Excluído');
        }
    }

    public function render()
    {
        $ambientes = Ambiente::all();
        return view('livewire.ambiente.ambiente-index', compact('ambientes'));
    }

     public function status($id){
        $ambiente = Ambiente::find($id);
        $ambiente->status = !$ambiente->status;
        $ambiente->save();
    }
}