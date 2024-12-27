<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'employer_name',
        'position',
        'occupation',
        'manager_name',
        'manager_email'
    ];
}
