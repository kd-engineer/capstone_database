<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = fake()->dateTime();

        return [
            'post_id' => fake()->randomElement(Post::pluck("id")),
            'user_id' => fake()->randomElement(User::pluck("id")),
            'body' => fake()->realText($maxNbChars = 200),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
