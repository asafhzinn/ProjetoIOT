<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use App\Models\Ambiente;
use Livewire\Component;

class SensorIndex extends Component
{
    public function render()
    {
        $sensores = Sensor::all();
        $nomesAmbientes = Ambiente::pluck('nome', 'id');
        return view('livewire.sensor.sensor-index', compact('sensores', 'nomesAmbientes'));
    }
}