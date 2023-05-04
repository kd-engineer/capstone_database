<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Friend;
use App\Models\Post;
use App\Models\Like;
use App\Models\FriendRequest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_picture',
        'gender',
        'birthdate',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friends(): HasMany {
        return $this->hasMany(Friend::class);
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class)->orderBy("created_at", "desc");
    }

    public function likes(): HasMany {
        return $this->hasMany(Like::class);
    }

    public function friendRequests(): HasMany {
        return $this->hasMany(FriendRequest::class)->orderBy('created_at', 'desc');
    }
}
