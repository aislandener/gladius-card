<?php

namespace Database\Factories;

use App\Models\Clan;
use App\Models\Warrior;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class WarriorFactory extends Factory
{
    protected $model = Warrior::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'photo' => $this->faker->word(),
            'xp' => $this->faker->randomNumber(4),
            'hp' => $this->faker->randomNumber(4),
            'is_leader' => false,

            'clan_id' => Clan::factory(),
        ];
    }
}
