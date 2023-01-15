<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    /**
     * table relationships
     */
    public function post()
    {
        $this->belongsToMany(Post::class);
    }
}
