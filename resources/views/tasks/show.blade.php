<!-- resources/views/tasks/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Détails de la tâche</h1>

    <div class="card">
        <div class="card-header">
            <h3>{{ $task->title }}</h3>
        </div>

        <div class="card-body">
            <p><strong>Description :</strong> {{ $task->description }}</p>
            <p><strong>Priorité :</strong> {{ ucfirst($task->priority) }}</p>
            <p><strong>Date limite :</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p>
            <p><strong>Statut :</strong> 
                <span class="badge {{ $task->status == 'ouverte' ? 'bg-warning' : 'bg-success' }}">
                    {{ ucfirst($task->status) }}
                </span>
            </p>
            <p><strong>Date de création :</strong> {{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}</p>
            <p><strong>Dernière mise à jour :</strong> {{ \Carbon\Carbon::parse($task->updated_at)->format('d/m/Y H:i') }}</p>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour à la liste</a>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">Modifier</a>
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
@endsection
