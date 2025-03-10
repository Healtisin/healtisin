<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $amount = fake()->randomElement([50000, 100000, 150000, 200000]);
        $duration = fake()->randomElement([30, 90, 180, 365]);
        
        return [
            'user_id' => $user->id,
            'amount' => $amount,
            'duration' => $duration,
            'payment_method' => fake()->randomElement(['bank_transfer', 'e-wallet', 'credit_card']),
            'status' => fake()->randomElement(['unpaid', 'paid', 'expired', 'failed']),
            'payment_proof' => fake()->boolean(70) ? 'proof.jpg' : null,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'customer_phone' => $user->phone ?? fake()->phoneNumber(),
            'expired_at' => now()->addDays(1),
            'payment_code' => fake()->regexify('[A-Z0-9]{10}'),
            'snap_token' => fake()->uuid(),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    /**
     * Indicate that the payment is paid.
     */
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'paid',
            'payment_proof' => 'proof.jpg',
            'updated_at' => fake()->dateTimeBetween($attributes['created_at'], 'now'),
        ]);
    }

    /**
     * Indicate that the payment is expired.
     */
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'expired',
            'expired_at' => now()->subDays(1),
        ]);
    }

    /**
     * Indicate that the payment is failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
} 