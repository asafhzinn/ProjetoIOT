<?php
namespace App\Livewire\Sensor;
use App\Models\Ambiente;
use App\Models\Sensor;
use Illuminate\View\View;
use Livewire\Component;
class SensorCreate extends Component
{
    public $ambiente_id = null;
    public string $codigo = '';
    public string $tipo = '';
    public string $descricao = '';
    public bool $status = true;
    protected function rules(): array { return ['ambiente_id' => ['required','exists:ambientes,id'], 'codigo' => ['required','string','max:255','unique:sensors,codigo'], 'tipo' => ['required','string','max:255'], 'descricao' => ['required','string','max:5000'], 'status' => ['boolean']]; }
    public function salvar(): void { Sensor::create($this->validate()); session()->flash('success', 'Sensor cadastrado com sucesso.'); $this->redirectRoute('sensores.index'); }
    public function render(): View { return view('livewire.sensor.sensor-create', ['ambientes' => Ambiente::orderBy('nome')->get()])->layout('components.layouts.app', ['title' => 'Novo sensor | Painel IoT']); }
}
