<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    //TODO Ajouter relation avec les factures
    //TODO Ajouter relation avec les messages
    //TODO Ajouter relation avec les roles

    //TODO Ajouter toutes les factures NON editables de l'utilisateur
    //TODO Ajouter scope pour récupérer les messages accessibles par l'utilisateur
}
