<!-- resources/views/tasks/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Toutes vos tâches</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Lien pour créer une nouvelle tâche -->
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Créer une nouvelle tâche</a>

    <!-- Liste des tâches -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Priorité</th>
                <th>Date limite</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <!-- Titre -->
                    <td>{{ $task->title }}</td>

                    <!-- Description -->
                    <td>{{ $task->description }}</td>

                    <!-- Priorité -->
                    <td>{{ ucfirst($task->priority) }}</td>

                    <!-- Date limite -->
                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</td>

                    <!-- Statut (Checkbox pour changer le statut) -->
                    <td>
                        <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" 
                                   name="status" 
                                   onchange="this.form.submit()" 
                                   {{ $task->status == 'terminée' ? 'checked' : '' }}>
                        </form>
                    </td>

                    <!-- Actions -->
                    <td>
                        <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
