<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $body = fake()->paragraphs();
        $newBody = "";
        $date = fake()->dateTime();

        foreach($body as $paragraph) {
        $newBody .= "<p>" . $paragraph . "</p>";
        }
        return [
            'user_id' => fake()->randomElement(User::pluck("id")),
            'body' => $newBody,
            'media' => "IMG_20230424_095141.jpg",
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
