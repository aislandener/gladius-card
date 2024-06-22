<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Insignia;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin \App\Models\Warrior */
class WarriorResource extends JsonResource
{
    public static $wrap = 'warrior';

    public static function collection($resource): WarriorCollection
    {
        return new WarriorCollection($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'photo' => Storage::disk('public')->url($this->photo),
            'xp' => $this->xp,
            'hp' => $this->hp,
            'xp_logo' => $this->logo_xp ? Storage::disk('public')->url($this->logo_xp) : null,
            'hp_logo' => $this->logo_hp ? Storage::disk('public')->url($this->logo_hp) : null,
            'is_leader' => $this->is_leader,
            $this->mergeWhen($this->is_leader, [
                'leader_logo' => $this->logo_leader ? Storage::disk('public')->url($this->logo_leader) : null,
            ]),
            'clan' => ClanResource::make($this->whenLoaded('clan')),
        ];
    }
}
