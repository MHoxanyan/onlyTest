<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PositionFormRequest;
use App\Http\Resources\User\PositionResource;
use App\Models\Position;
use App\Services\User\PositionService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return PositionResource::collection(
            Position::with('comfortLevels')->paginate($request->count ?? 15)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionFormRequest $request)
    {
        $position = PositionService::createOrUpdate($request->validated('name'));
        return PositionResource::make($position->loadMissing('comfortLevels'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): PositionResource
    {
        return PositionResource::make(
            Position::query()->with('comfortLevels')->findOrFail($id),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionFormRequest $request, int $id): PositionResource
    {
        $position = PositionService::createOrUpdate($request->validated('name'), $id);
        return PositionResource::make($position->loadMissing('comfortLevels'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) Position::destroy($id),
        ]);
    }
}
