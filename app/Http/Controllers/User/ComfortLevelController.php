<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ComfortLevelFormRequest;
use App\Http\Resources\User\ComfortLevelResource;
use App\Models\ComfortLevel;
use App\Services\User\ComfortLevelService;
use Illuminate\Http\Request;

class ComfortLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return ComfortLevelResource::collection(
            ComfortLevel::query()->paginate($request->count ?? 15),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComfortLevelFormRequest $request)
    {
        $comfortLevel = ComfortLevelService::createOrUpdate($request->validated('name'));
        return ComfortLevelResource::make($comfortLevel)
            ->additional(['status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ComfortLevelResource::make(
            ComfortLevel::query()->findOrFail($id),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComfortLevelFormRequest $request, string $id)
    {
        $comfortLevel = ComfortLevelService::createOrUpdate($request->validated('name'), $id);
        return ComfortLevelResource::make($comfortLevel)
            ->additional([
                'status' => true,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) ComfortLevel::destroy($id),
        ]);
    }
}
