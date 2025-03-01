<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController2;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProyectoController;

// el middleware verifica si el usuario está autenticado
Route::get("main", MainController::class);

Route::resource("alumnos", AlumnoController::class)
->middleware('auth');


Route::view("/","welcome")->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get("language/{locale}", LanguageController::class)->name('language');
require __DIR__.'/auth.php'; // Cargando correctamente las rutas de autenticación.

Route::middleware(['auth'])->group(function () {
    Route::resource('proyectos', ProyectoController::class);
});

