<?php

namespace App\Livewire\Ambiente;

use App\Models\Ambiente;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Ambientes')]
class Ambientes extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public ?int $ambienteId = null;

    public string $nome = '';

    public string $descricao = '';

    public bool $status = true;

    public string $busca = '';

    protected function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'boolean',
        ];
    }

    protected $validationAttributes = [
        'nome' => 'nome',
        'descricao' => 'descrição',
    ];

    public function updatingBusca(): void
    {
        $this->resetPage();
    }

    public function salvar(): void
    {
        $dados = $this->validate();

        if ($this->ambienteId) {
            Ambiente::findOrFail($this->ambienteId)->update($dados);
            session()->flash('sucesso', 'Ambiente atualizado com sucesso.');
        } else {
            Ambiente::create($dados);
            session()->flash('sucesso', 'Ambiente cadastrado com sucesso.');
        }

        $this->cancelar();
    }

    public function editar(int $id): void
    {
        $ambiente = Ambiente::findOrFail($id);

        $this->ambienteId = $ambiente->id;
        $this->nome = $ambiente->nome;
        $this->descricao = (string) $ambiente->descricao;
        $this->status = (bool) $ambiente->status;
        $this->resetValidation();
    }

    public function excluir(int $id): void
    {
        $ambiente = Ambiente::withCount('sensores')->findOrFail($id);

        if ($ambiente->sensores_count > 0) {
            session()->flash('erro', 'Não é possível excluir um ambiente que possui sensores vinculados.');

            return;
        }

        $ambiente->delete();

        if ($this->ambienteId === $id) {
            $this->cancelar();
        }

        session()->flash('sucesso', 'Ambiente excluído com sucesso.');
    }

    public function cancelar(): void
    {
        $this->reset(['ambienteId', 'nome', 'descricao', 'status']);
        $this->resetValidation();
    }

    public function render()
    {
        $ambientes = Ambiente::withCount('sensores')
            ->when($this->busca, fn ($q) => $q->where('nome', 'like', "%{$this->busca}%"))
            ->orderBy('nome')
            ->paginate(10);

        return view('livewire.ambiente.ambientes', compact('ambientes'));
    }
}
