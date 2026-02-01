<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        $name = $this->faker->company() . ' FC';
        
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'city' => $this->faker->city(),
            'stadium' => $this->faker->optional()->words(2, true) . ' Stadium',
            'founded_year' => $this->faker->numberBetween(1900, 2020),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }
}

