<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    use HasFactory;

    /**
     * table relationships
     */
    public function post()
    {
        $this->hasMany(Post::class);
    }
}
