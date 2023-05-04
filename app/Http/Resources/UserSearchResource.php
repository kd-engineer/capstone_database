<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSearchResource extends JsonResource
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
            'profile_picture' => $this->profile_picture
        ];
    }
}
