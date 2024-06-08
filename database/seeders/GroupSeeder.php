<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        Group::factory()->count(3)->state(new Sequence(
            [
                'name' => 'XP',
                'field' => 'xp',
            ],
            [
                'name' => 'HP',
                'field' => 'hp',
            ],
            [
                'name' => 'Leader',
                'field' => null,
            ],
        ))->create();
    }
}
