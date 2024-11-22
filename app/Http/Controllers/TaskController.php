<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks; // Récupère les tâches associées à l'utilisateur connecté
        return view('tasks.index', compact('tasks'));
    }

    // Affiche le formulaire pour ajouter une nouvelle tâche
    public function create()
    {
        return view('tasks.create');
    }

    // Enregistre une nouvelle tâche dans la base de données
    public function store(Request $request)
{
    // Validation des données
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'priority' => 'required|in:haute,moyenne,basse',
        'due_date' => 'required|date|after_or_equal:today',
    ]);

    // Création de la tâche
    $task = new Task();
    $task->title = $validated['title'];
    $task->description = $validated['description'];
    $task->priority = $validated['priority'];
    $task->due_date = $validated['due_date'];
    $task->user_id = auth()->id();  // Lier la tâche à l'utilisateur authentifié
    $task->status = 'ouverte'; // Par défaut, la tâche est ouverte
    $task->save();

    // Redirection avec un message de succès
    return redirect()->route('tasks.index')->with('success', 'La tâche a été créée avec succès.');
}

    // Affiche le formulaire pour modifier une tâche existante
    public function edit(Task $task)
    {
        // Vérifie si la tâche appartient à l'utilisateur connecté
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        return view('tasks.edit', compact('task'));
    }

    // Met à jour les informations d'une tâche
    public function update(Request $request, Task $task)
    {
        // Vérifie si la tâche appartient à l'utilisateur connecté
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        // Validation des données entrées
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:haute,moyenne,basse',
            'due_date' => 'required|date',
            'status' => 'required|in:ouverte,terminée',
        ]);

        // Mise à jour de la tâche
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function updateStatus(Task $task)
{
    // Change le statut de la tâche
    $task->status = $task->status == 'ouverte' ? 'terminée' : 'ouverte';
    $task->save();

    // Retourne à la liste des tâches avec un message de succès
    return redirect()->route('tasks.index')->with('success', 'Le statut de la tâche a été mis à jour avec succès.');
}
    // Supprime une tâche
    public function destroy(Task $task)
    {
        // Vérifie si la tâche appartient à l'utilisateur connecté
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        // Suppression de la tâche
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }

    // Affiche les détails d'une tâche spécifique
    public function show(Task $task)
    {
        // Vérifie si la tâche appartient à l'utilisateur connecté
        if ($task->user_id != Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Vous n\'avez pas accès à cette tâche.');
        }

        return view('tasks.show', compact('task'));
    }
}
