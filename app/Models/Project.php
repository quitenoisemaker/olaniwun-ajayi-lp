<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['title', 'description'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
