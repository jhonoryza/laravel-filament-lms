<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\ModuleSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Module::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'module_section_id' => ModuleSection::factory(),
            'title'             => $this->faker->sentence(4),
            'order'             => $this->faker->randomNumber(),
            'content'           => $this->faker->paragraphs(3, true),
        ];
    }
}
