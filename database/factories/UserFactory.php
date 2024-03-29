<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'profile_picture_path' => $this->faker->imageUrl(),
            'attendance_pin' => $this->faker->randomNumber(4),
            'phone_number' => $this->faker->phoneNumber(),
            'postal_code' => $this->faker->postcode(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'society' => $this->faker->company(),
            'biography' => $this->faker->paragraph(),
            'is_hidden' => $this->faker->boolean(),
        ];
    }
}
