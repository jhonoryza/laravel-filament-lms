<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\ModuleSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleSectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModuleSection::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title'     => $this->faker->sentence(4),
            'order'     => $this->faker->randomNumber(),
            'course_id' => Course::factory(),
        ];
    }
}
