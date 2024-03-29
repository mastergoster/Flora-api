<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, HasRoles;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'profile_picture_path',
        'attendance_pin',
        'phone_number',
        'postal_code',
        'street',
        'city',
        'society',
        'biography',
        'is_hidden',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'attendance_pin',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'is_hidden' => 'boolean',
    ];

    /**
     * Get the invoices associated with the user.
     *
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class)
            ->where('is_editable', false);
    }

    /**
     * Get the messages associated with the user.
     *
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'to_user_id')
            ->where('to_user_id', $this->id)
            ->orWhereIn('to_role_id', $this->roles->pluck('id'));
    }
}
