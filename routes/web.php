<?php

use App\Livewire\Ambiente\AmbienteCreate;
use App\Livewire\Ambiente\AmbienteEdit;
use App\Livewire\Ambiente\AmbienteIndex;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Sensor\SensorCreate;
use App\Livewire\Sensor\SensorEdit;
use App\Livewire\Sensor\SensorIndex;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', Dashboard::class)->name('dashboard');

Route::get('/ambientes', AmbienteIndex::class)->name('ambientes.index');
Route::get('/ambientes/create', AmbienteCreate::class)->name('ambientes.create');
Route::get('/ambientes/{ambiente}/edit', AmbienteEdit::class)->name('ambientes.edit');

Route::get('/sensores', SensorIndex::class)->name('sensores.index');
Route::get('/sensores/create', SensorCreate::class)->name('sensores.create');
Route::get('/sensores/{sensor}/edit', SensorEdit::class)->name('sensores.edit');
