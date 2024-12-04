<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoModule extends Model
{
    protected $fillable = [
      'page',
      'meta_title',
      'meta_description',
      'is_show',
    ];
}
