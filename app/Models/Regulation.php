<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'document_path',
        'effective_date',
        'is_active',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'is_active' => 'boolean',
    ];
}
