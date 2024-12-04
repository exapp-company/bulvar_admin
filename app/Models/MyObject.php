<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyObject extends Model
{
    protected $table = 'objects';
    protected $fillable = [
        'name',
        'project_id',
        'status',
        'description',
        'price',
        'is_show'
    ];

    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
