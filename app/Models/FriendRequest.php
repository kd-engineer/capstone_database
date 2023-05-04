<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Belongsto;

class FriendRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_to'
    ];

    // public function belongsTo(): Belongsto {
    //     return $this->belongsTo(User::class);
    // }
}
