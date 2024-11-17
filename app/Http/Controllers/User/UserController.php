<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUpdateUserFormRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return UserResource::collection(
            User::with('position')->paginate($request->count ?? 15)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUpdateUserFormRequest $request)
    {
        $user = UserService::createOrUpdate($request->getDTO());
        return UserResource::make($user->loadMissing('position'))
            ->additional(['status' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(
            User::with('position')->findOrFail($id)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateUpdateUserFormRequest $request, string $id)
    {
        $user = UserService::createOrUpdate($request->getDTO());
        return UserResource::make(
            $user->loadMissing('position'),
        )->additional(['status' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            'status' => (bool) User::destroy($id)
        ]);
    }
}
