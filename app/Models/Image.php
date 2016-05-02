<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
    	'filename', 'file'
    ];

    public function task()
    {
    	return $this->belongsTo(\App\Models\Task::class);
    }
}
