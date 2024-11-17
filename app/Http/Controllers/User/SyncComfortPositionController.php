<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SyncComfortPositionFormRequest;
use App\Models\PositionComfort;
use Illuminate\Http\JsonResponse;

class SyncComfortPositionController extends Controller
{
    public function __invoke(SyncComfortPositionFormRequest $request): JsonResponse
    {
        $position = $request->validated('position_id');
        PositionComfort::where('position_id', $position)->delete();

        $now = now();
        PositionComfort::insert(array_map(fn($level) => [
            'position_id' => $position,
            'comfort_level_id' => $level,
            'created_at' => $now,
            'updated_at' => $now,
        ], $request->validated('comfort_levels')));

        return response()->json([
            'status' => true,
        ]);
    }
}
