<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\Admin\PropietarioController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');
});

require __DIR__.'/auth.php';

/* --------- RUTAS DE ADMINISTRADOR --------- */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/condo/admin/propietarios/create', [PropietarioController::class, 'create'])
         ->name('admin.propietarios.create');
    Route::post('/condo/admin/propietarios', [PropietarioController::class, 'store'])
         ->name('admin.propietarios.store');
});


/* Dashboard del propietario */
Route::middleware(['auth'])->prefix('propietario')->group(function () {
    Route::view('/dashboard', 'propietario.dashboard')->name('propietario.dashboard');
});


/* Área del propietario (sin forzar perfil por ahora) */
Route::middleware(['auth'])->prefix('propietario')->group(function () {

    Route::view('/dashboard', 'propietario.dashboard')->name('propietario.dashboard');

    // Rutas de perfil (vacías por ahora, pero definidas)
    Route::get('/perfil/edit',   [\App\Http\Controllers\Propietario\PerfilController::class, 'edit'])
         ->name('perfil.edit');
    Route::post('/perfil/update', [\App\Http\Controllers\Propietario\PerfilController::class, 'update'])
         ->name('perfil.update');

    // CRUD de integrantes/familiares
    Route::resource('integrantes', \App\Http\Controllers\Propietario\IntegranteController::class);
});