<!-- resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Créer une nouvelle tâche</h1>

    <!-- Affichage des erreurs de validation si nécessaire -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire de création de tâche -->
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Priorité</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="haute" {{ old('priority') == 'haute' ? 'selected' : '' }}>Haute</option>
                <option value="moyenne" {{ old('priority') == 'moyenne' ? 'selected' : '' }}>Moyenne</option>
                <option value="basse" {{ old('priority') == 'basse' ? 'selected' : '' }}>Basse</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Date limite</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer la tâche</button>
    </form>
@endsection
