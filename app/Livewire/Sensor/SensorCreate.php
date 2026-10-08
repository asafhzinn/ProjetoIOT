<?php

namespace App\Livewire\Sensor;

use App\Models\Ambiente;
use App\Models\Sensor;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Novo sensor')]
class SensorCreate extends Component
{
    public $ambiente_id = '';

    public string $codigo = '';

    public string $tipo = '';

    public string $descricao = '';

    public bool $status = true;

    protected function rules(): array
    {
        return [
            'ambiente_id' => 'required|exists:ambientes,id',
            'codigo' => 'required|string|max:255|unique:sensors,codigo',
            'tipo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'status' => 'boolean',
        ];
    }

    protected $validationAttributes = [
        'ambiente_id' => 'ambiente',
        'codigo' => 'código',
        'descricao' => 'descrição',
    ];

    public function salvar()
    {
        Sensor::create($this->validate());

        session()->flash('sucesso', 'Sensor cadastrado com sucesso.');

        return $this->redirectRoute('sensores.index');
    }

    public function render()
    {
        return view('livewire.sensor.sensor-create', [
            'ambientes' => Ambiente::orderBy('nome')->get(),
        ]);
    }
}
