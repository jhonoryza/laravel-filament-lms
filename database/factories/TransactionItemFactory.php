<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'course_id' => Course::factory(),
            'price' => $this->faker->randomNumber(),
            'quantity' => $this->faker->randomNumber(),
            'total' => $this->faker->randomNumber(),
        ];
    }
}
