<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        $positions = ['Gardien', 'Défenseur', 'Milieu', 'Attaquant'];
        
        return [
            'team_id' => Team::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->randomElement($positions),
            'jersey_number' => $this->faker->numberBetween(1, 99),
            'date_of_birth' => $this->faker->dateTimeBetween('-35 years', '-18 years'),
            'nationality' => $this->faker->country(),
            'height' => $this->faker->numberBetween(160, 200),
            'weight' => $this->faker->numberBetween(60, 100),
            'is_active' => true,
        ];
    }
}

