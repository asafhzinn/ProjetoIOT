<?php

namespace Tests\Feature;

use App\Livewire\Sensor\Sensores;
use App\Models\Ambiente;
use App\Models\Registro;
use App\Models\Sensor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SensorCrudTest extends TestCase
{
    use RefreshDatabase;

    private Ambiente $ambiente;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ambiente = Ambiente::create(['nome' => 'Laboratório']);
    }

    private function criarSensor(string $codigo = 'TEMP01'): Sensor
    {
        return Sensor::create([
            'ambiente_id' => $this->ambiente->id,
            'codigo' => $codigo,
            'tipo' => 'temperatura',
            'descricao' => 'Sensor de temperatura',
        ]);
    }

    public function test_pagina_de_sensores_carrega(): void
    {
        $this->criarSensor();

        $this->get('/sensores')->assertOk()->assertSeeLivewire(Sensores::class)->assertSee('TEMP01');
    }

    public function test_cadastra_sensor(): void
    {
        Livewire::test(Sensores::class)
            ->set('ambiente_id', $this->ambiente->id)
            ->set('codigo', 'LED01')
            ->set('tipo', 'led')
            ->set('descricao', 'LED da sala')
            ->call('salvar')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('sensors', ['codigo' => 'LED01', 'ambiente_id' => $this->ambiente->id]);
    }

    public function test_valida_campos_obrigatorios(): void
    {
        Livewire::test(Sensores::class)
            ->call('salvar')
            ->assertHasErrors(['ambiente_id', 'codigo', 'tipo', 'descricao']);
    }

    public function test_codigo_deve_ser_unico(): void
    {
        $this->criarSensor('TEMP01');

        Livewire::test(Sensores::class)
            ->set('ambiente_id', $this->ambiente->id)
            ->set('codigo', 'TEMP01')
            ->set('tipo', 'temperatura')
            ->set('descricao', 'x')
            ->call('salvar')
            ->assertHasErrors(['codigo' => 'unique']);
    }

    public function test_edita_sensor_mantendo_codigo(): void
    {
        $sensor = $this->criarSensor();

        Livewire::test(Sensores::class)
            ->call('editar', $sensor->id)
            ->assertSet('codigo', 'TEMP01')
            ->set('tipo', 'umidade')
            ->call('salvar')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('sensors', ['id' => $sensor->id, 'codigo' => 'TEMP01', 'tipo' => 'umidade']);
    }

    public function test_exclui_sensor(): void
    {
        $sensor = $this->criarSensor();

        Livewire::test(Sensores::class)->call('excluir', $sensor->id);

        $this->assertDatabaseMissing('sensors', ['id' => $sensor->id]);
    }

    public function test_nao_exclui_sensor_com_registros(): void
    {
        $sensor = $this->criarSensor();
        Registro::create(['sensor_id' => $sensor->id, 'valor' => '25', 'unidade' => 'C', 'data_hora' => now()]);

        Livewire::test(Sensores::class)->call('excluir', $sensor->id);

        $this->assertDatabaseHas('sensors', ['id' => $sensor->id]);
    }
}
