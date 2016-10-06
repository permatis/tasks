<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name', 'url',
    ];

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_page');
    }
}
