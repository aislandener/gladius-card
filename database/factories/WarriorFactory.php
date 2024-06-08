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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'photo' => $this->faker->word(),
            'xp' => $this->faker->word(),
            'hp' => $this->faker->word(),
            'is_leader' => $this->faker->boolean(),

            'clan_id' => Clan::factory(),
        ];
    }
}
