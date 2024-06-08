<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Insignia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class InsigniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Insignia::factory()->count(9)->state(new Sequence(
            [
                'name' => 'Aprendiz',
                'group_id' => Group::where('field', 'xp')->first()->id,
                'path' => 'Insignia/xp_aprendiz.png',
                'requirement' => 120
            ],
            [
                'name' => 'Guerreiro',
                'group_id' => Group::where('field', 'xp')->first()->id,
                'path' => 'Insignia/xp_guerreiro.png',
                'requirement' => 400
            ],
            [
                'name' => 'Mestre',
                'group_id' => Group::where('field', 'xp')->first()->id,
                'path' => 'Insignia/xp_mestre.png',
                'requirement' => 800
            ],
            [
                'name' => 'Lendário',
                'group_id' => Group::where('field', 'xp')->first()->id,
                'path' => 'Insignia/xp_lendario.png',
                'requirement' => 1500
            ],
            [
                'name' => 'Guerreiro de Aço',
                'group_id' => Group::where('field', 'hp')->first()->id,
                'path' => 'Insignia/hp_guerreiro.png',
                'requirement' => 500
            ],
            [
                'name' => 'Muralha de Guerra',
                'group_id' => Group::where('field', 'hp')->first()->id,
                'path' => 'Insignia/hp_muralha.png',
                'requirement' => 1500
            ],
            [
                'name' => 'Indestrutível',
                'group_id' => Group::where('field', 'hp')->first()->id,
                'path' => 'Insignia/hp_indestrutivel.png',
                'requirement' => 3000
            ],
            [
                'name' => 'Fúria Lendária',
                'group_id' => Group::where('field', 'hp')->first()->id,
                'path' => 'Insignia/hp_furia.png',
                'requirement' => 6000
            ],
            [
                'name' => 'Mestre Fundador',
                'group_id' => Group::whereNull('field')->first()->id,
                'path' => 'Insignia/fundador.png',
                'requirement' => null
            ]
        ))->create();
    }
}
