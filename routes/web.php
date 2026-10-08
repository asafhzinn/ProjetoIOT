<?php

use App\Livewire\Ambiente\AmbienteCreate;
use App\Livewire\Ambiente\AmbienteEdit;
use App\Livewire\Ambiente\AmbienteIndex;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Sensor\SensorCreate;
use App\Livewire\Sensor\SensorEdit;
use App\Livewire\Sensor\SensorIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('home');
Route::get('/dashboard', Dashboard::class)->name('Dashboard');

Route::prefix('ambientes')->name('ambientes.')->group(function () {
    Route::get('/', AmbienteIndex::class)->name('index');
    Route::get('/create', AmbienteCreate::class)->name('create');
    Route::get('/{ambiente}/edit', AmbienteEdit::class)->name('edit');
});

Route::prefix('sensores')->name('sensores.')->group(function () {
    Route::get('/', SensorIndex::class)->name('index');
    Route::get('/create', SensorCreate::class)->name('create');
    Route::get('/{sensor}/edit', SensorEdit::class)->name('edit');
});
