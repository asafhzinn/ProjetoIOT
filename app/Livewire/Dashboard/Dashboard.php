<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Sensor;
use App\Models\Registro;

class Dashboard extends Component
{
    // Variáveis públicas exigidas pelo seu arquivo dashboard.blade.php
    public $totalSensores = 0;
    public $statusAmbiente = 'Monitorando';
    public $registros = [];

    // Esta função atualiza os dados na tela em tempo real (chamada pelo wire:poll)
    public function atualizarDados()
    {
        // 1. Conta quantos sensores existem cadastrados no banco de dados
        $this->totalSensores = Sensor::count();

        // 2. Define o status do ambiente baseado no último registro inserido
        $ultimoRegistroGeral = Registro::orderBy('id', 'desc')->first();
        if ($ultimoRegistroGeral) {
            $this->statusAmbiente = 'Ativo (' . date('H:i:s', strtotime($ultimoRegistroGeral->data_hora)) . ')';
        } else {
            $this->statusAmbiente = 'Sem registros';
        }

        // 3. Busca os últimos 10 registros reais que o seu Controller inseriu no banco
        $dadosBanco = Registro::orderBy('id', 'desc')
            ->take(10)
            ->get();

        // 4. Formata os dados para o padrão exato que a sua tabela no Blade espera receber
        $this->registros = $dadosBanco->map(function ($reg) {
            // Tenta encontrar o código do sensor correspondente
            $sensor = Sensor::find($reg->sensor_id);
            $nomeSensor = $sensor ? 'Sensor: ' . $sensor->codigo : 'Sensor #' . $reg->sensor_id;

            return [
                'id' => $reg->id,
                'horario' => date('d/m/Y H:i:s', strtotime($reg->data_hora)),
                'sensor' => $nomeSensor,
                'valor' => $reg->valor . ' ' . $reg->unidade,
                'classe_status' => 'bg-primary' // Classe de cor azul do Bootstrap 5
            ];
        })->toArray();
    }

    // Método executado na primeira inicialização do componente em tela
    public function mount()
    {
        $this->atualizarDados();
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard');
    }
}
