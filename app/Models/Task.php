<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    // Définir les colonnes modifiables
    protected $fillable = [
        'title',
        'description',
        'priority',
        'due_date',
        'status',
        'user_id',
    ];

    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
