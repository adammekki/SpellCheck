<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Score extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'user_id',
        'username',
        'score'
    ];
}
