<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'category_id' => Category::where('model_type', 'App\Models\Post')->get()->random()->id,
            'title' => $title = $this->faker->sentence($nbWords = 8),
            'subtitle' => $this->faker->sentence($nbWords = 8),
            'slug' => Str::slug($title, '-'),
            'seo_title' => $this->faker->sentence($nbWords = 8),
            'body' => $this->faker->text($maxNbChars = 1000),
            'image' => 'image',
            'meta_description' => $this->faker->sentence($nbWords = 8),
            'meta_keywords' => $this->faker->sentence($nbWords = 8),
            'status' => 'Published',
            'featured' => $this->faker->randomElement([0, 1]),
        ];
    }
}
