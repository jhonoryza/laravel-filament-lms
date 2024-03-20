<?php

namespace Database\Factories;

use App\Enum\MidtransPaymentStatus;
use App\Enum\PaymentMethod;
use App\Enum\TransactionStatus;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'admin_id'       => Admin::factory(),
            'status'         => $this->faker->randomElement(TransactionStatus::toArray()),
            'number'         => $this->faker->word(),
            'total'          => $this->faker->randomNumber(),
            'course'         => '{}',
            'snap_token'     => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'payment_method' => $this->faker->randomElement(PaymentMethod::toArray()),
            'payment_status' => $this->faker->randomElement(MidtransPaymentStatus::toArray()),
            'pending_at'     => $this->faker->dateTime(),
            'expired_at'     => $this->faker->dateTime(),
            'failed_at'      => $this->faker->dateTime(),
            'success_at'     => $this->faker->dateTime(),
        ];
    }
}
