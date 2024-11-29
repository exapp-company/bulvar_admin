<?php

namespace App\Models;

use App\Traits\HasGeo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{

    use HasFactory, SoftDeletes, HasGeo;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'country_id',
        'lat',
        'lon'
    ];

    protected $dates = ['deleted_at'];
}
