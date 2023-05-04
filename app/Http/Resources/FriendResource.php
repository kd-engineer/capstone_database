<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $name = $this->friend->first_name . ' ' .$this->friend->last_name;

        return [
            'id' => $this->friend->id,
            'name' => $name,
            'profile_picture' => $this->profile_picture
        ];
    }
}
