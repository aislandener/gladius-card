<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarriorResource;
use App\Models\Warrior;
use Illuminate\Http\Request;

class RetrivedAllWarriors extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return WarriorResource::collection(Warrior::with('clan')->get());
    }
}
