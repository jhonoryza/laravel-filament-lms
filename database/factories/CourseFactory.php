<?php

namespace Database\Factories;

use App\Enum\CourseType;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     * @throws RandomException
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $isPremium = $this->faker->boolean();
        return [
            'slug' => Str::slug($title),
            'title' => $this->faker->sentence(4),
            'type' => $this->faker->randomElement(CourseType::toArray()),
            'is_premium' => $isPremium,
            'price' => $isPremium ? random_int(10_000, 120_000) : 0,
            'discount' => $isPremium ? random_int(1, 20) : 0,
            'description' => $this->faker->text(),
            'published_at' => now(),
        ];
    }
}
