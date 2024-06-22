<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Warrior */
class WarriorCollection extends ResourceCollection
{

    public $resource = WarriorResource::class;

    public static $wrap = null;
    public function toArray(Request $request): array
    {
        return [
            'warriors' => $this->collection,

        ];
    }
}
