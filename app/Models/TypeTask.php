<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTask extends Model
{
    protected $fillable = ['name'];
    
    public $timestamps = false;

    public function task()
    {
    	return $this->belongsTo(\App\Models\Task::class);
    }
}
