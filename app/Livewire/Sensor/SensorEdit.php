<?php

namespace App\Livewire\Sensor;

use App\Models\Ambiente;
use App\Models\Sensor;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Component;

class SensorEdit extends Component
{
    public Sensor $sensor;
    public $ambiente_id = null;
    public string $codigo = '';
    public string $tipo = '';
    public string $descricao = '';
    public bool $status = true;

    public function mount($id): void
    {
        $sensor = Sensor::find($id);
        $this->sensor = $sensor;
        $this->ambiente_id = $sensor->ambiente_id;
        $this->codigo = $sensor->codigo;
        $this->tipo = $sensor->tipo;
        $this->descricao = $sensor->descricao;
        $this->status = (bool) $sensor->status;
    }
    protected function rules(): array
    {
        return ['ambiente_id' => ['required', 'exists:ambientes,id'], 'codigo' => ['required', 'string', 'max:255', Rule::unique('sensors', 'codigo')->ignore($this->sensor->id)], 'tipo' => ['required', 'string', 'max:255'], 'descricao' => ['required', 'string', 'max:5000'], 'status' => ['boolean']];
    }
    public function atualizar(): void
    {
        $this->sensor->update($this->validate());
        session()->flash('success', 'Sensor atualizado com sucesso.');
        $this->redirectRoute('sensor.index');
    }
    public function render(): View
    {
        return view('livewire.sensor.sensor-edit', ['ambientes' => Ambiente::orderBy('nome')->get()])->layout('components.layouts.app', ['title' => 'Editar sensor | Painel IoT']);
    }
}
