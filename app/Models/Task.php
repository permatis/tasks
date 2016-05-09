<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    	'name', 'budget', 'price', 'url', 'description', 'published', 'user_id', 'type_id',  'status_id', 'image_id'
    ];

    public function status()
    {
    	return $this->hasMany(\App\Models\StatusTask::class, 'id', 'status_id');
    }

    public function type()
    {
    	return $this->hasMany(\App\Models\TypeTask::class, 'id', 'type_id');
    }

    public function image()
    {
    	return $this->hasMany(\App\Models\Image::class, 'id', 'image_id');
    }

    public function user()
    {
    	return $this->hasMany(\App\Models\User::class, 'id', 'user_id');
    }

    public function userTask()
    {
        return $this->belongsToMany(\App\Models\User::class, 'join_task', 'task_id', 'user_id')
            ->withPivot('id', 'task_id', 'user_id', 'status');
    }

    public function commented()
    {
    	return $this->belongsToMany(\App\Models\User::class, 'commented', 'task_id', 'user_id')
            ->withPivot('id', 'text', 'user_id',  'task_id');
    }
}
