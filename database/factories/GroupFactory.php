<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $groupsArray = ['PZ-11', 'PZ-12', 'PZ-13', 'PZ-21', 'PZ-22', 'PZ-23', 'PZ-24', 'PZ-25'];
        // $name = $this->faker->randomElement($groupsArray);
        // while (Group::where('name', $name)->exists()) {
        //     $name = $this->faker->randomElement($groupsArray);
        // }
        return [
            // 'name' => $name,
        ];
    }
}
