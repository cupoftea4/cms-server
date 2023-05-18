<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    // protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['M', 'F', 'B']);
        $name = $gender === 'M' ? $this->faker->firstNameMale : $this->faker->firstNameFemale;
        return [
            'name' => $name,
            'surname' => $this->faker->lastName,
            'gender' => $gender,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'birthday' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'group_id' => Group::all()->random()->id,
        ];
    }
}
