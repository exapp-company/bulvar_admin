<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{


    protected $fillable = [
        'name',
        'status',
        'description',
        'is_show'
    ];


    public function objects(): HasMany
    {
        return $this->hasMany(MyObject::class);
    }
}
