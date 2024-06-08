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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'logo' => $this->faker->word(),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
