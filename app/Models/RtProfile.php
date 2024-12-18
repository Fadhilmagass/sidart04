<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RtProfile extends Model
{
    protected $fillable = [
        'name',
        'description',
        'history',
        'address',
        'map_embed',
        'phone',
        'email',
    ];
}
