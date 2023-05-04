<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "friends_with",
    ];

    public function users(): BelongsTo {
        return $this->BelongsTo(User::class, "user_id");
    }

    public function friend(): BelongsTo {
        return $this->BelongsTo(User::class, "friends_with");
    }
        
    public function friends(): BelongsTo {
        return $this->BelongsTo(User::class, "friends_with");
    }
}