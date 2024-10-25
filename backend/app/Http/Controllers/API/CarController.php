<?php

namespace App\Http\Controllers\API;

use App\Models\Car;
use App\Events\CarUpdated;
use App\Jobs\CarUpdatedJob;
use App\Traits\ApiResponse;
use App\Enums\ModelStatusEnum;
use App\Http\Requests\CarRequest;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarCollection;

class CarController extends Controller
{
    use ApiResponse;

    public function index()
    {
        // TODO (IMPROVEMENT): Use Caching
        return $this->successResponse(new CarCollection(Car::with('user')->available()->paginate(20)), 'Cars retrieved successfully');
    }


    public function store(CarRequest $request)
    {
        $car = Car::create($request->validated());

        $carResource = new CarResource($car);
        dispatch(new CarUpdatedJob($carResource,ModelStatusEnum::created()));

        return $this->successResponse($carResource, 'Car created successfully');
    }

    public function show(Car $car)
    {
        return $this->successResponse(new CarResource($car), 'Car retrieved successfully');
    }

    public function update(CarRequest $request, Car $car)
    {
        // IF THE OWNER OF THE CAR
        $this->authorize('update', $car);

        $car->update($request->validated());

        $carResource = new CarResource($car);
        dispatch(new CarUpdatedJob($carResource,ModelStatusEnum::updated()));

        return $this->successResponse($carResource, 'Car updated successfully');
    }

    public function destroy(Car $car)
    {
        // IF THE OWNER OF THE CAR
        $this->authorize('delete', $car);
        // soft delete
        $car->delete();

        dispatch(new CarUpdatedJob(new CarResource($car),ModelStatusEnum::deleted()));

        return $this->successResponse(null, 'Car deleted successfully');
    }

}
