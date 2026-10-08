<?php

namespace App\Livewire\Sensor;

use App\Models\Ambiente;
use App\Models\Sensor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Sensores')]
class Sensores extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public ?int $sensorId = null;

    public $ambiente_id = '';

    public string $codigo = '';

    public string $tipo = '';

    public string $descricao = '';

    public bool $status = true;

    public string $busca = '';

    protected function rules(): array
    {
        return [
            'ambiente_id' => 'required|exists:ambientes,id',
            'codigo' => ['required', 'string', 'max:255', Rule::unique('sensors', 'codigo')->ignore($this->sensorId)],
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

    public function updatingBusca(): void
    {
        $this->resetPage();
    }

    public function salvar(): void
    {
        $dados = $this->validate();

        if ($this->sensorId) {
            Sensor::findOrFail($this->sensorId)->update($dados);
            session()->flash('sucesso', 'Sensor atualizado com sucesso.');
        } else {
            Sensor::create($dados);
            session()->flash('sucesso', 'Sensor cadastrado com sucesso.');
        }

        $this->cancelar();
    }

    public function editar(int $id): void
    {
        $sensor = Sensor::findOrFail($id);

        $this->sensorId = $sensor->id;
        $this->ambiente_id = $sensor->ambiente_id;
        $this->codigo = $sensor->codigo;
        $this->tipo = $sensor->tipo;
        $this->descricao = (string) $sensor->descricao;
        $this->status = (bool) $sensor->status;
        $this->resetValidation();
    }

    public function excluir(int $id): void
    {
        $sensor = Sensor::withCount('registros')->findOrFail($id);

        if ($sensor->registros_count > 0) {
            session()->flash('erro', 'Não é possível excluir um sensor que possui registros.');

            return;
        }

        $sensor->delete();

        if ($this->sensorId === $id) {
            $this->cancelar();
        }

        session()->flash('sucesso', 'Sensor excluído com sucesso.');
    }

    public function cancelar(): void
    {
        $this->reset(['sensorId', 'ambiente_id', 'codigo', 'tipo', 'descricao', 'status']);
        $this->resetValidation();
    }

    public function render()
    {
        $sensores = Sensor::with('ambiente')
            ->when($this->busca, function ($q) {
                $q->where(fn ($q) => $q->where('codigo', 'like', "%{$this->busca}%")
                    ->orWhere('tipo', 'like', "%{$this->busca}%"));
            })
            ->orderBy('codigo')
            ->paginate(10);

        return view('livewire.sensor.sensores', [
            'sensores' => $sensores,
            'ambientes' => Ambiente::orderBy('nome')->get(),
        ]);
    }
}
