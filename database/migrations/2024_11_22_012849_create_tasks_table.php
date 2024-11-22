<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // titre de la tâche
            $table->text('description'); // description détaillée
            $table->enum('priority', ['haute', 'moyenne', 'basse']); // priorité
            $table->date('due_date'); // date limite
            $table->enum('status', ['ouverte', 'terminée'])->default('ouverte'); // statut (ouverte ou terminée)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // clé étrangère vers la table users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
