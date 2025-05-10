<?php

namespace Database\Factories;



use App\Models\ForumCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ForumCategoryFactory extends Factory
{
    protected $model = ForumCategory::class;

    public function definition()
    {

        $carCategories = [
            'Engine Parts',
            'Suspension Systems',
            'Brakes',
            'Car Electronics',
            'Oil & Fluids',
            'Wheels & Tires',
            'Interior Accessories',
            'Body Parts',
            'Lighting',
            'Car Maintenance'
        ];

        $name = $this->faker->unique()->randomElement($carCategories);

        return [
            'name' => ucfirst($name),
        ];
    }
}
