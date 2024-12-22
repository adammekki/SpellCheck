<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'score',
        'credit',
        'startDate',
        'endDate',
        'type',
    ];
}
