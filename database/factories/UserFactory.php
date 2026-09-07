<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{

    protected static ?string $password;


    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(), // Generates a random first name
            'last_name' => fake()->lastName(),   // Generates a random last name
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber(), // Generates a random phone number
            'country' => fake()->country(), // Generates a random country
            'city' => fake()->city(), // Generates a random city
            'postcode' => fake()->postcode(), // Generates a random postcode
            'state' => fake()->state(), // Generates a random state
            'street_and_number' => fake()->streetAddress(), // Generates a random street address
        ];
    }

   
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
