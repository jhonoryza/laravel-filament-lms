<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'admin_id'   => Admin::factory(),
            'session_id' => $this->faker->word(),
            'data'       => '{}',
        ];
    }
}
