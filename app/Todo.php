<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model 
{
    private $owner_id;

    protected $fillable = [
        'text',
        'checked'
    ];

    protected $table = 'todo';
}
