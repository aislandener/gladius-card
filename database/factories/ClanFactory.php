<?php

namespace Database\Factories;

use App\Models\Clan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClanFactory extends Factory
{
    protected $model = Clan::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'logo' => $this->faker->word(),
            'is_default' => $this->faker->boolean(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
