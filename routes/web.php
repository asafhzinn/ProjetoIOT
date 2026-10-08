<?php


use App\Livewire\Ambiente\AmbienteCreate;
use App\Livewire\Ambiente\AmbienteIndex;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', Dashboard::class)->name('Dashboard');

Route::get('/Ambientes', AmbienteIndex::class)->name('Ambientes.index');
Route::get('/ambientes/create', AmbienteCreate::class)->name('ambientes.create');

