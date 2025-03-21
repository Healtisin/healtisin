<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'news/news-' . $this->faker->numberBetween(1, 5) . '.jpg',
            'category' => $this->faker->randomElement(['Kesehatan', 'Teknologi', 'Gaya Hidup', 'Medis']),
            'meta_description' => $this->faker->sentence(10),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
