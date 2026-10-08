<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Ambiente;
use App\Models\Sensor;
use App\Models\Registro;

class Dashboard extends Component
{
    public $ambienteSelecionado = '';

    public function render()
    {
        $ambientes = Ambiente::all();

        // 2. Conta os sensores cadastrados
        $totalSensores = Sensor::count();

        // 3. Conta o total de registros coletados
        $totalRegistros = Registro::count();

        // 4. Pega o valor do último registro de temperatura (opcional)
        // Se você não tiver um sensor específico de temperatura, pode deixar estático ou adaptar
        $ultimaLeitura = Registro::latest()->first();
        $ultimaTemperatura = $ultimaLeitura ? $ultimaLeitura->valor : 0;

        // 5. Monta a query para a tabela aplicando o filtro se houver um ambiente selecionado
        $queryRegistros = Registro::with(['sensor.ambiente'])->latest();

        if ($this->ambienteSelecionado) {
            $queryRegistros->whereHas('sensor', function ($query) {
                $query->where('ambiente_id', $this->ambienteSelecionado);
            });
        }

        // Pega as últimas 10 leituras filtradas
        $registros = $queryRegistros->take(10)->get();

        // 6. Retorna a view injetando todas as variáveis necessárias
        return view('livewire.dashboard.dashboard', [
            'ambientes' => $ambientes,
            'totalSensores' => $totalSensores,
            'totalRegistros' => $totalRegistros,
            'ultimaTemperatura' => $ultimaTemperatura,
            'registros' => $registros,
        ]);
    }
}