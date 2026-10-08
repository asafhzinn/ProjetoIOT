<?php
namespace App\Livewire\Ambiente;
use App\Models\Ambiente;
use Illuminate\View\View;
use Livewire\Component;
class AmbienteCreate extends Component
{
    public string $nome = '';
    public string $descricao = '';
    public bool $status = true;
    protected function rules(): array { return ['nome' => ['required','string','max:255'], 'descricao' => ['nullable','string','max:5000'], 'status' => ['boolean']]; }
    public function salvar(): void
    {
        $dados = $this->validate();
        Ambiente::create($dados);
        session()->flash('success', 'Ambiente cadastrado com sucesso.');
        $this->redirectRoute('ambientes.index');
    }
    public function render(): View { return view('livewire.ambiente.ambiente-create')->layout('components.layouts.app', ['title' => 'Novo ambiente | Painel IoT']); }
}
