<?php

namespace App\Livewire\Sensor;

use Livewire\Component;

class SensorCreate extends Component
{
    public $ambiente_id;
    public $codigo;
    public $tipo = false;
    public $descricao;
    public $status = true;

    public function salvar(){
        
    }
    public function render()
    {
        return view('livewire.sensor.sensor-create');
    }
}
