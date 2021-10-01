<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // User
        return [
            'name' => $this->faker->unique()->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'User',
            'password' => '$2y$10$lNhdC75bfqnZq/I/Fm7U2.y..avQtSP5fyW5vDgBnUryDQ4ZYyd1K', // password - 12345678
        ];

        // Admin
        //-----------------------------------------------------------------------------------------------------------
        // return [
        //     'name' => 'Admin',
        //     'email' => 'admin.admin@yandex.ru',
        //     'role' => 'Admin',
        //     'password' => '$2y$10$lNhdC75bfqnZq/I/Fm7U2.y..avQtSP5fyW5vDgBnUryDQ4ZYyd1K', // password - 12345678
        // ];
        //-----------------------------------------------------------------------------------------------------------
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
