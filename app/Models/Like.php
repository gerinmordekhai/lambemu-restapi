<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    /**
     * table relationships
     */
    public function post()
    {
        $this->hasMany(Post::class);
    }
}
