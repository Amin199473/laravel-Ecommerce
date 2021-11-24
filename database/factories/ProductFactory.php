<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $Image_path = ['2.jpg', '3.jpg', '1.jpg', '4.jpg', '6.jpg', '5.jpg', '7.jpg', '8.jpg'];

        return [
            'user_id' => User::all()->random()->id,
            'name' => $name = $this->faker->realText($maxNbChars = 15, $indexSize = 2),
            'title' => $title = $this->faker->sentence($nbWords = 8),
            'slug' => Str::slug($title, '-'),
            'images' => json_encode(["1.jpg", "3.jpg", "2.jpg", "4.jpg"]),
            'summary' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
            'sku' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
            'sales' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 500),
            'discount' => $this->faker->randomDigit(),
            'descriptions' => $this->faker->text($maxNbChars = 200),
            'status' => $this->faker->randomElement(['Published', 'Soon']),
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'published_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
