<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Insignia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InsigniaFactory extends Factory
{
    protected $model = Insignia::class;

    public function definition()
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'path' => $this->faker->word(),
            'requirement' => $this->faker->word(),

            'group_id' => Group::factory(),
        ];
    }
}
