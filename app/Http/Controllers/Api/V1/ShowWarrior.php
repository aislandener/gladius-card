<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarriorResource;
use App\Models\Warrior;
use Illuminate\Http\Request;

class ShowWarrior extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Warrior $warrior)
    {
        return WarriorResource::make($warrior->load('clan'));
    }
}
