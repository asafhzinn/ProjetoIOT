<?php
namespace App\Livewire\Ambiente;
use App\Models\Ambiente;
use Illuminate\View\View;
use Livewire\Component;
class AmbienteEdit extends Component
{
    public Ambiente $ambiente;
    public string $nome = '';
    public string $descricao = '';
    public bool $status = true;
    public function mount(Ambiente $ambiente): void { $this->ambiente = $ambiente; $this->nome = $ambiente->nome; $this->descricao = $ambiente->descricao ?? ''; $this->status = (bool) $ambiente->status; }
    protected function rules(): array { return ['nome' => ['required','string','max:255'], 'descricao' => ['nullable','string','max:5000'], 'status' => ['boolean']]; }
    public function atualizar(): void
    {
        $this->ambiente->update($this->validate());
        session()->flash('success', 'Ambiente atualizado com sucesso.');
        $this->redirectRoute('ambientes.index');
    }
    public function render(): View { return view('livewire.ambiente.ambiente-edit')->layout('components.layouts.app', ['title' => 'Editar ambiente | Painel IoT']); }
}
