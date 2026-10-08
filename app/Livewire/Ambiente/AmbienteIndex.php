<?php
namespace App\Livewire\Ambiente;
use App\Models\Ambiente;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
class AmbienteIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public string $search = '';
    public string $status = '';
    protected $queryString = ['search', 'status'];
    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }
    public function excluir(int $id): void
    {
        $ambiente = Ambiente::findOrFail($id);
        if ($ambiente->sensores()->exists()) { session()->flash('error', 'Não é possível excluir este ambiente enquanto houver sensores vinculados a ele.'); return; }
        $ambiente->delete();
        session()->flash('success', 'Ambiente excluído com sucesso.');
    }
    public function render(): View
    {
        $ambientes = Ambiente::query()->withCount('sensores')
            ->when($this->search !== '', fn ($query) => $query->where(fn ($query) => $query->where('nome', 'like', '%'.$this->search.'%')->orWhere('descricao', 'like', '%'.$this->search.'%')))
            ->when($this->status !== '', fn ($query) => $query->where('status', $this->status === '1'))
            ->latest()->paginate(10);
        return view('livewire.ambiente.ambiente-index', compact('ambientes'))->layout('components.layouts.app', ['title' => 'Ambientes | Painel IoT']);
    }
}
