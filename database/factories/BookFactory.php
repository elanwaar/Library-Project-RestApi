<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'author' => fake()->name(),	
            'collection' => fake()->name(),	
            'isbn' => fake()->name(),
            'publish_date' => fake()->date(),				
            'pages_number' => fake()->numberBetween(1,1000),	
            'location' => fake()->name(),	
            'content' => fake()->text(),	
            'category_id' => Category::factory()
        ];
    }
}
