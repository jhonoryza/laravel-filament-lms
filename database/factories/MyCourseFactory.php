<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Course;
use App\Models\MyCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

class MyCourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MyCourse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'admin_id' => Admin::factory(),
            'course_id' => Course::factory(),
            'is_completed' => $this->faker->boolean,
            'completed_modules' => null
        ];
    }
}
