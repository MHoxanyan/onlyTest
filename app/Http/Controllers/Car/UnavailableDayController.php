<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\UnavailableDayFormRequest;
use App\Http\Resources\Car\UnavailableDayResource;
use App\Models\CarUnavailableDay;
use App\Services\Car\CarService;
use Illuminate\Http\Request;

class UnavailableDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return UnavailableDayResource::collection(
            CarUnavailableDay::with(['car', 'user'])->paginate($request->count ?? 15),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnavailableDayFormRequest $request)
    {
        $unavailableDay = CarService::createOrUpdateUnavailableDay($request->getDTO());

        return UnavailableDayResource::make($unavailableDay->loadMissing(['car', 'user']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return UnavailableDayResource::make(
            CarUnavailableDay::with(['car', 'user'])->find($id),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnavailableDayFormRequest $request, string $id)
    {
        $unavailableDat = CarService::createOrUpdateUnavailableDay($request->getDTO());

        return UnavailableDayResource::make(
            $unavailableDat->loadMissing(['car', 'user']),
        )->additional(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) CarUnavailableDay::destroy($id),
        ]);
    }
}
