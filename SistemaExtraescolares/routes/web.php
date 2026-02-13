<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

use App\Http\Controllers\TallerController;

Route::post('/taller/inscribir', [TallerController::class, 'inscribir'])->name('taller.inscribir');

Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('student.eliminar');

Route::get('/student/{studentId}/generate-certificate/{tallerId}', [StudentController::class, 'generateCertificate'])->name('student.generateCertificate');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::put('/admin/student/{id}', [DashboardController::class, 'editStudent'])->name('admin.student.edit');
    Route::delete('/admin/student/{id}', [DashboardController::class, 'deleteStudent'])->name('admin.student.destroy');
});

Route::get('/student/{id}', [StudentController::class, 'showTaller'])->name('student.show');
Route::get('/student/{studentId}/taller/{tallerId}', [StudentController::class, 'showTaller'])->name('student.show');

Route::get('instructor/{id}/taller/{tallerId?}', [InstructorController::class, 'show'])->name('instructor.detalles');

Route::post('/instructor/update/{id}', [InstructorController::class, 'update'])->name('instructor.update');

use App\Http\Controllers\DirectivoController;

Route::get('/directivos', [DirectivoController::class, 'index'])->name('directivos.index');
Route::post('/directivos', [DirectivoController::class, 'store'])->name('directivos.store');

Route::get('/directivos', [DirectivoController::class, 'index'])->name('directivos');
Route::get('/directivos/{id}/edit', [DirectivoController::class, 'edit'])->name('directivos.edit');
Route::delete('/directivos/{id}', [DirectivoController::class, 'destroy'])->name('directivos.destroy');
Route::put('/directivos/{directivo}', [DirectivoController::class, 'update'])->name('directivos.update');

Route::get('/talleres', [TallerController::class, 'index'])->name('talleres.index');
Route::get('/talleres/create', [TallerController::class, 'create'])->name('talleres.create');
Route::post('/talleres', [TallerController::class, 'store'])->name('talleres.store');
Route::get('/talleres/{id}/edit', [TallerController::class, 'edit'])->name('talleres.edit');
Route::put('/talleres/{id}', [TallerController::class, 'update'])->name('talleres.update');
Route::delete('/talleres/{id}', [TallerController::class, 'destroy'])->name('talleres.destroy');

use App\Http\Controllers\ExportController;

Route::get('/export/alumnos/csv', [ExportController::class, 'exportAlumnosToCSV'])->name('export.alumnos.csv');

Route::get('/instructores', [InstructorController::class, 'index'])->name('instructores.index');
Route::get('/instructores/{id}/edit', [InstructorController::class, 'edit'])->name('instructores.edit');
Route::put('/instructores/{id}', [InstructorController::class, 'update'])->name('instructores.update');
require __DIR__.'/auth.php';
