<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gaji' => $this->faker->numberBetween(1000000, 9999999),
            'nip' => $this->faker->unique()->numberBetween(100000000, 999999999),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'picture' => 'https://i.ibb.co/0jZzQYH/IMG-20201212-120751.jpg',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'role' => 'Admin',
            'remember_token' => Str::random(10),
            'is_kepala_unit' => true,
            'is_tim_keuangan' => true,
            'is_unit' => true,
            'is_operator' => true,
            'is_pbj' => true,
            'is_ppk' => true,
            'is_admin' => true,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
