<?php

namespace Database\Seeders;

use App\Models\Clan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ClanSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clan::factory()->count(5)->state(new Sequence(
            [
                'name' => 'Legionarius',
                'logo' => 'Clan/Legionarius.png',
                'is_default' => false,
                'color' => '#8e0000',
            ],
            [
                'name' => 'Annarr',
                'logo' => 'Clan/Annarr.png',
                'is_default' => false,
                'color' => '#242424',
            ],
            [
                'name' => 'Cavaleiros',
                'logo' => 'Clan/Cavaleiros.png',
                'is_default' => false,
                'color' => '#072785',
            ],
            [
                'name' => 'Sem clã',
                'logo' => 'Clan/Wolfstrider.png',
                'is_default' => false,
                'color' => '#23381e',
            ],
            [
                'name' => 'Black',
                'logo' => null,
                'is_default' => true,
                'color' => '#ffffff',
            ],
        ))->create();
    }
}
