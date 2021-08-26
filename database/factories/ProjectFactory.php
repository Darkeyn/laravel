<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name(),
            'adress' => $this->faker->sentence(),
            'ssh' => $this->faker->sentence(),
            'admin_login' => $this->faker->word(),
            'admin_password' => $this->faker->word()
        ];
    }
}
