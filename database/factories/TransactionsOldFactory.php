<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionsOld>
 */
class TransactionsOldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 4),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => 85731804492,
            'province' => 13,
            'city' => 1303,
            'kecamatan' => 1303050,
            'kelurahan' => 1303050001,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'total_amount' => $this->faker->randomFloat(2, 0, 100000),
            'points_earned' => $this->faker->numberBetween(0, 1000),
            'points_used' => $this->faker->numberBetween(0, 1000),
            'temp_points_used' => $this->faker->numberBetween(0, 1000),
            'status' => 1,
            'proof_of_payment' => $this->faker->text,
            'payment_status' => $this->faker->numberBetween(0, 1),
            'created_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
