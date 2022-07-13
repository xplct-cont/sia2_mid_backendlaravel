<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lname' => $this->faker->lastName(),
            'fname' => $this->faker->firstName(),
            'course' => $this->faker->randomElement(['BSIT', 'BSHM', 'BSN', 'BSED']),
            'year' => $this->faker->randomElement(['4th Year', '3rd Year', '2nd Year', '1st Year']),
            'address' => $this->faker->address(),
            'mobile' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
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