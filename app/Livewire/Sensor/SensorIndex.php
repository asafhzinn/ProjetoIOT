<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use App\Models\Ambiente;
use Livewire\Component;

class SensorIndex extends Component
{
    public $search='';

    public function delete($id){
        $sensor = Sensor::find($id);

        if($sensor != null){
            $sensor->delete();
            session()->flash('success', 'Excluído');
        }
    }

    public function render()
    {
        $sensores = Sensor::all();
        $nomesAmbientes = Ambiente::pluck('nome', 'id');
        return view('livewire.sensor.sensor-index', compact('sensores', 'nomesAmbientes'));
    }

    public function status($id){
        $sensor = Sensor::find($id);
        $sensor->status = !$sensor->status;
        $sensor->save();
    }
}