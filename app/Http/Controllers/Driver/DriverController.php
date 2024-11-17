<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Driver\DriverCreateUpdateFormRequest;
use App\Http\Resources\Driver\DriverResource;
use App\Models\Driver;
use App\Services\Driver\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return DriverResource::collection(
            Driver::query()->paginate($request->count ?? 15),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverCreateUpdateFormRequest $request)
    {
        $driver = DriverService::createOrUpdate($request->validated('name'));

        return DriverResource::make($driver)
            ->additional(['status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return DriverResource::make(
            Driver::query()->findOrFail($id),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverCreateUpdateFormRequest $request, int $id)
    {
        $driver = DriverService::createOrUpdate($request->validated('name'), $id);

        return DriverResource::make($driver)
            ->additional(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) Driver::destroy($id),
        ]);
    }
}
