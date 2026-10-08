<?php

namespace Tests\Feature;

use App\Livewire\Ambiente\AmbienteCreate;
use App\Livewire\Ambiente\AmbienteEdit;
use App\Livewire\Ambiente\AmbienteIndex;
use App\Models\Ambiente;
use App\Models\Sensor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AmbienteCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_paginas_carregam(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Laboratório']);

        $this->get('/ambientes')->assertOk()->assertSeeLivewire(AmbienteIndex::class)->assertSee('Laboratório');
        $this->get('/ambientes/create')->assertOk()->assertSeeLivewire(AmbienteCreate::class);
        $this->get("/ambientes/{$ambiente->id}/edit")->assertOk()->assertSeeLivewire(AmbienteEdit::class);
    }

    public function test_cadastra_ambiente(): void
    {
        Livewire::test(AmbienteCreate::class)
            ->set('nome', 'Laboratório')
            ->set('descricao', 'Sala 1')
            ->call('salvar')
            ->assertHasNoErrors()
            ->assertRedirect(route('ambientes.index'));

        $this->assertDatabaseHas('ambientes', ['nome' => 'Laboratório', 'descricao' => 'Sala 1', 'status' => true]);
    }

    public function test_nome_e_obrigatorio(): void
    {
        Livewire::test(AmbienteCreate::class)
            ->call('salvar')
            ->assertHasErrors(['nome' => 'required']);
    }

    public function test_edita_ambiente(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Antigo']);

        Livewire::test(AmbienteEdit::class, ['ambiente' => $ambiente])
            ->assertSet('nome', 'Antigo')
            ->set('nome', 'Novo')
            ->set('status', false)
            ->call('salvar')
            ->assertHasNoErrors()
            ->assertRedirect(route('ambientes.index'));

        $this->assertDatabaseHas('ambientes', ['id' => $ambiente->id, 'nome' => 'Novo', 'status' => false]);
    }

    public function test_exclui_ambiente(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Excluir']);

        Livewire::test(AmbienteIndex::class)->call('excluir', $ambiente->id);

        $this->assertDatabaseMissing('ambientes', ['id' => $ambiente->id]);
    }

    public function test_nao_exclui_ambiente_com_sensores(): void
    {
        $ambiente = Ambiente::create(['nome' => 'Com sensor']);
        Sensor::create(['ambiente_id' => $ambiente->id, 'codigo' => 'TEMP01', 'tipo' => 'temperatura', 'descricao' => 'x']);

        Livewire::test(AmbienteIndex::class)->call('excluir', $ambiente->id);

        $this->assertDatabaseHas('ambientes', ['id' => $ambiente->id]);
    }
}
