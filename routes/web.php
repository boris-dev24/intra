<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::middleware(['auth'])->group(function () {
    // Route pour afficher la liste des tâches
    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    
    // Route pour afficher le formulaire de création d'une tâche
    Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    
    // Route pour enregistrer une nouvelle tâche
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    
    // Route pour afficher les détails d'une tâche
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    
    // Route pour afficher le formulaire d'édition d'une tâche
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    
    // Route pour mettre à jour une tâche
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    
    // Route pour supprimer une tâche
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    
    
});
Auth::routes();