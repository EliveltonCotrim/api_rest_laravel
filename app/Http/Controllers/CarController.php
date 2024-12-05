<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::orderBy('model')->paginate(10);

        return CarResource::collection($cars)->response()->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        try {
            $car = Car::create($request->all());

            return response()->json("Car created successfully", JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        try {
            $car->update($request->all());

            return response()->json("Car updated successfully.", JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        try {
            $car->deleteOrFail();

            return response()->json("Car deleted successfully.", JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
