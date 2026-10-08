<?php

use App\Livewire\Ambiente\Ambientes;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Sensor\Sensores;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/ambientes', Ambientes::class)->name('ambientes');
Route::get('/sensores', Sensores::class)->name('sensores');
