<?php

namespace App\Livewire\Sensor;

use App\Models\Ambiente;
use App\Models\Sensor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Editar sensor')]
class SensorEdit extends Component
{
    public Sensor $sensor;

    public $ambiente_id = '';

    public string $codigo = '';

    public string $tipo = '';

    public string $descricao = '';

    public bool $status = true;

    protected function rules(): array
    {
        return [
            'ambiente_id' => 'required|exists:ambientes,id',
            'codigo' => ['required', 'string', 'max:255', Rule::unique('sensors', 'codigo')->ignore($this->sensor->id)],
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

    public function mount(Sensor $sensor): void
    {
        $this->sensor = $sensor;
        $this->ambiente_id = $sensor->ambiente_id;
        $this->codigo = $sensor->codigo;
        $this->tipo = $sensor->tipo;
        $this->descricao = (string) $sensor->descricao;
        $this->status = (bool) $sensor->status;
    }

    public function salvar()
    {
        $this->sensor->update($this->validate());

        session()->flash('sucesso', 'Sensor atualizado com sucesso.');

        return $this->redirectRoute('sensores.index');
    }

    public function render()
    {
        return view('livewire.sensor.sensor-edit', [
            'ambientes' => Ambiente::orderBy('nome')->get(),
        ]);
    }
}
