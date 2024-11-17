<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarCreateUpdateFormRequest;
use App\Http\Resources\Car\CarResource;
use App\Models\Car;
use App\Services\Car\CarService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CarResource::collection(
            Car::with(['driver', 'comfortLevel'])->paginate($request->count ?? 15),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarCreateUpdateFormRequest $request)
    {
        $car = CarService::createOrUpdate($request->getDTO());

        return CarResource::make(
            $car->loadMissing(['driver', 'comfortLevel']),
        )->additional(['status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CarResource::make(
            Car::with(['driver', 'comfortLevel'])->find($id),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarCreateUpdateFormRequest $request, string $id)
    {
        $car = CarService::createOrUpdate($request->getDTO());

        return CarResource::make(
            $car->loadMissing(['driver', 'comfortLevel']),
        )->additional(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) Car::destroy($id),
        ]);
    }
}
