<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Technology',
            'Engineering',
            'Goverment',
            'Medical',
            'Construction',
            'software',
            'educate',
            'programming'
        ];
        $array = ['App\Models\Post', 'App\Models\Product'];
        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'model_type' => Arr::random($array),
            ]);
        }

        $brands = [
            'audi',
            'microsoft',
            'sony',
            'bmw',
            'benz',
            'louis vuitton'
        ];
        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
            ]);
        }

        \App\Models\User::factory(20)->create();
        \App\Models\Profile::factory(20)->create();
        \App\Models\Product::factory(20)->create();
        \App\Models\Post::factory(20)->create();
    }
}
