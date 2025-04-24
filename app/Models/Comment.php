<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo

class Comment extends Model
{
    use HasFactory;

    // Allow these fields to be mass assigned
    protected $fillable = ['post_id', 'name', 'body'];

    /**
     * Get the post that owns the comment.
     */
    public function post(): BelongsTo // Type hint the return type
    {
        // A comment belongs to a post
        return $this->belongsTo(Post::class);
    }
}