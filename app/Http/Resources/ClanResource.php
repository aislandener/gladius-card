<?php

namespace App\Http\Resources;

use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin Clan */
class ClanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'logo' => Storage::disk('public')->url($this->logo),
            'color' => $this->color,
        ];
    }
}
