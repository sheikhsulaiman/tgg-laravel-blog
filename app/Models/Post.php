<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class Post extends Model
{
    use HasFactory;

    // Allow these fields to be mass assigned
    protected $fillable = ['title', 'body'];

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany // Type hint the return type
    {
        // A post can have many comments
        return $this->hasMany(Comment::class);
    }
}