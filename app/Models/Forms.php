<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forms extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_show'
    ];
}
