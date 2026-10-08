<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use Livewire\Component;

class SensorEdit extends Component
{
    public $id;
    public $ambiente_id = '';
    public $codigo = '';
    public $tipo = '';
    public $descricao = '';
    public $status = true;

    public function mount($id){
       
        $sensor = Sensor::find($id);

        $this->id = $sensor->id;
        $this->codigo = $sensor->codigo;
        $this->tipo = $sensor->tipo;
        $this->descricao = $sensor->descricao;
        $this->status = $sensor->status;
    }

    public function update(){
       $ambiente= Sensor::find($this->id);

       

       $ambiente->nome = $this->nome;
       $ambiente->status = $this->status;
       $ambiente->descricao = $this->descricao;

       $ambiente->save();

       session()->flash('success', 'Atualizado');

       return redirect()->route('sensor.index');
    }
    public function render()
    {
        return view('livewire.sensor.sensor-edit');
    }
}