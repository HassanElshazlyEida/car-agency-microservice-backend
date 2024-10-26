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
use Illuminate\Http\Request;

class CarController extends Controller
{
    use ApiResponse;

    public function index()
    {
        // TODO (IMPROVEMENT): Use Caching
        return $this->successResponse(new CarCollection(Car::orderby('created_at','desc')->available()->paginate(20)), 'Cars retrieved successfully');
    }


    public function store(CarRequest $request)
    {
        $car = Car::create($request->validated());

        $carResource = new CarResource($car);
        
        CarUpdatedJob::dispatch($carResource->toArray($request),ModelStatusEnum::created()->value);

        return $this->successResponse($carResource, 'Car created successfully');
    }

    public function show(Car $car)
    {
        return $this->successResponse(new CarResource($car), 'Car retrieved successfully');
    }

    public function update(CarRequest $request, Car $car)
    {
        $car->update($request->validated());

        $carResource = new CarResource($car);
        CarUpdatedJob::dispatch($carResource->toArray($request),ModelStatusEnum::updated()->value);

        return $this->successResponse($carResource, 'Car updated successfully');
    }

    public function destroy(Request $request, Car $car)
    {
        // soft delete
        $car->delete();

        CarUpdatedJob::dispatch((new CarResource($car))->toArray($request),ModelStatusEnum::deleted()->value);

        return $this->successResponse(null, 'Car deleted successfully');
    }

}
