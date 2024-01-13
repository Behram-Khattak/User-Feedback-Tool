<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => "Lorem ipsum dolor sit amet consectetur adipisicing elit",
            'slug' => "Lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit",
            'category' => "lorem",
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. At nisi molestiae consequatur nobis aliquam tempore maxime tenetur laudantium doloribus sapiente, eaque quas minus, beatae, eveniet temporibus voluptatum. Cum, laborum! Voluptatem.",
        ];
    }
}
