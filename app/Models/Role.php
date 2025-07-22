<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    const ADMIN = 'admin';
    const USER = 'user';


    protected $fillable = ['name', 'slug'];

    /**
     * Get the user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
