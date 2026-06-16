<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\AspectoController;
use App\Http\Controllers\Admin\CriterioController;
use App\Http\Controllers\Admin\ConcursoController;
use App\Http\Controllers\Admin\ParticipanteController;
use App\Http\Controllers\Jurado\EvaluacionController;
use App\Http\Controllers\Admin\ResultadoController;
use App\Http\Controllers\Admin\BitacoraController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware(['auth', 'role:ADMINISTRADOR'])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');
    Route::post('concursos/{concurso}/cerrar', [ConcursoController::class, 'cerrar'])
    ->name('concursos.cerrar');
    Route::resource('participantes', ParticipanteController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('aspectos', AspectoController::class);
    Route::resource('criterios', CriterioController::class);
    Route::get('concursos/{concurso}/resultados', [ResultadoController::class, 'index'])
    ->name('concursos.resultados');
    Route::resource('concursos', ConcursoController::class);
    Route::get('concursos/{concurso}/criterios', [ConcursoController::class, 'criterios'])
    ->name('concursos.criterios');
    Route::post('concursos/{concurso}/criterios', [ConcursoController::class, 'guardarCriterios'])
    ->name('concursos.criterios.guardar');
    Route::get('concursos/{concurso}/jurados', [ConcursoController::class, 'jurados'])
    ->name('concursos.jurados');

    Route::post('concursos/{concurso}/jurados', [ConcursoController::class, 'guardarJurados'])
    ->name('concursos.jurados.guardar');

    Route::get('/admin/resultados/{concurso}/resumen-pdf', [ResultadoController::class, 'exportarResumenPDF'])
    ->name('concursos.resultados.exportarResumenPDF');

    Route::get('/admin/resultados/{concurso}/desglose-excel', [ResultadoController::class, 'exportarDesgloseExcel'])
    ->name('concursos.resultados.exportarDesgloseExcel');

});
    Route::get('bitacoras', [BitacoraController::class, 'index'])
    ->name('bitacoras.index');

    Route::middleware(['auth', 'role:JURADO'])->group(function () {
    Route::get('/jurado', function () {
        return view('dashboard.jurado');
    })->name('jurado.dashboard');
});
Route::middleware(['auth', 'role:JURADO'])->prefix('jurado')->name('jurado.')->group(function () {
    Route::get('/concursos', [EvaluacionController::class, 'concursos'])
        ->name('concursos.index');

    Route::get('/concursos/{concurso}/calificar', [EvaluacionController::class, 'calificar'])
        ->name('concursos.calificar');

    Route::post('/concursos/{concurso}/calificar', [EvaluacionController::class, 'guardar'])
        ->name('concursos.guardar');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', function () {
        if (auth()->user()->role !== 'ADMINISTRADOR') {
            abort(403, 'No tienes permiso para modificar tu perfil.');
        }

        return app(\App\Http\Controllers\ProfileController::class)->edit(request());
    })->name('profile.edit');

    Route::patch('/profile', function (\Illuminate\Http\Request $request) {
        if (auth()->user()->role !== 'ADMINISTRADOR') {
            abort(403, 'No tienes permiso para modificar tu perfil.');
        }

        return app(\App\Http\Controllers\ProfileController::class)->update($request);
    })->name('profile.update');

    Route::delete('/profile', function (\Illuminate\Http\Request $request) {
        if (auth()->user()->role !== 'ADMINISTRADOR') {
            abort(403, 'No tienes permiso para eliminar tu perfil.');
        }

        return app(\App\Http\Controllers\ProfileController::class)->destroy($request);
    })->name('profile.destroy');

});

require __DIR__.'/auth.php';