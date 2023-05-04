<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;


class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        "user_id",
        "post_id",
        "body",
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class)->orderBy;
    }
}
