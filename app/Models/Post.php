<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
      'img',
      'desc',  
    ];

    /**
     * table relationships
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function comments()
    {
        $this->belongsToMany(Comment::class);
    }

    public function likes()
    {
        $this->belongsTo(Like::class);
    }

    public function saves()
    {
        $this->belongsTo(Save::class);
    }
}
