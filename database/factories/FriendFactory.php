<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = fake()->randomElement(User::pluck("id"));
        $friends_with = fake()->randomElement(User::pluck("id"));

        while ($user === $friends_with) {
            $friends_with = fake()->randomElement(User::pluck("id"));
        }

        return [
            'user_id' => $user,
            'friends_with' => $friends_with
        ];
    }
}
