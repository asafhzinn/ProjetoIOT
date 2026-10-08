<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Ambientes')]
class AmbienteIndex extends Component
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
        $ambiente = Ambiente::withCount('sensores')->findOrFail($id);

        if ($ambiente->sensores_count > 0) {
            session()->flash('erro', 'Não é possível excluir um ambiente que possui sensores vinculados.');

            return;
        }

        $ambiente->delete();

        session()->flash('sucesso', 'Ambiente excluído com sucesso.');
    }

    public function render()
    {
        $ambientes = Ambiente::withCount('sensores')
            ->when($this->busca, fn ($q) => $q->where('nome', 'like', "%{$this->busca}%"))
            ->orderBy('nome')
            ->paginate(10);

        return view('livewire.ambiente.ambiente-index', compact('ambientes'));
    }
}
