<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FriendResource;
use App\Http\Resources\FeedResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $this->first_name . ' ' . $this->last_name;
        
        return [
            'id' => $this->id,
            'name' => $name,
            'profile_picture' => $this->profile_picture,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'friends' => FriendResource::collection($this->friends),
        ];
    }
}
