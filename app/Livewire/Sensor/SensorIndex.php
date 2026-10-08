<?php
namespace App\Livewire\Sensor;
use App\Models\Sensor;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
class SensorIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public string $search = '';
    public string $status = '';
    protected $queryString = ['search', 'status'];
    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }
    public function excluir(int $id): void { Sensor::findOrFail($id)->delete(); session()->flash('success', 'Sensor excluído com sucesso.'); }
    public function render(): View
    {
        $sensores = Sensor::query()->with('ambiente')
            ->when($this->search !== '', fn ($query) => $query->where(fn ($query) => $query->where('codigo', 'like', '%'.$this->search.'%')->orWhere('tipo', 'like', '%'.$this->search.'%')->orWhere('descricao', 'like', '%'.$this->search.'%')->orWhereHas('ambiente', fn ($query) => $query->where('nome', 'like', '%'.$this->search.'%'))))
            ->when($this->status !== '', fn ($query) => $query->where('status', $this->status === '1'))
            ->latest()->paginate(10);
        return view('livewire.sensor.sensor-index', compact('sensores'))->layout('components.layouts.app', ['title' => 'Sensores | Painel IoT']);
    }
}
