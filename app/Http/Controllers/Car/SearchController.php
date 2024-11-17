<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\Car\SearchFormRequest;
use App\Http\Resources\Car\CarResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    public function __invoke(SearchFormRequest $request)
    {
        $cars = $this->search($request->validated());

        return CarResource::collection($cars);
    }

    private function search(array $params): LengthAwarePaginator
    {
        $user = User::query()->find($params['user_id']);

        return Car::query()
            ->whereHas('comfortLevel', function ($query) use ($user) {
                $query->whereHas('positions', function ($query) use ($user) {
                    $query->where('position_id', $user->position_id);
                });
            })
            ->whereDoesntHave('unavailableDays', function ($query) use ($params) {
                $query->available($params['start'], $params['end']);
            })->paginate();
    }
}
