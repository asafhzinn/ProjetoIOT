<?php

namespace App\Livewire\Sensor;

use App\Models\Sensor;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Sensores')]
class SensorIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public string $busca = '';

    public function updatingBusca(): void
    {
        $this->resetPage();
    }

    public function excluir(int $id): void
    {
        $sensor = Sensor::withCount('registros')->findOrFail($id);

        if ($sensor->registros_count > 0) {
            session()->flash('erro', 'Não é possível excluir um sensor que possui registros.');

            return;
        }

        $sensor->delete();

        session()->flash('sucesso', 'Sensor excluído com sucesso.');
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

        return view('livewire.sensor.sensor-index', compact('sensores'));
    }
}
