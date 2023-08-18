<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Task extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'description',
        'due_date',
        'user_id',
        'priority',
    ];
}
