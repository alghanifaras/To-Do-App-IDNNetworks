<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
            'title',
           'description',
           'priority',
           'status',
           'tags',
           'is_important',
           'due_date',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_important' => 'boolean',
        'due_date' => 'date',
    ];
}
