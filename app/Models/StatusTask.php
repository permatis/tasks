<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTask extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public $timestamps = false;

    public function task()
    {
        return $this->belongsTo(\App\Models\Task::class);
    }
}
