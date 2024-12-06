<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    /**
     * Listar carros.
     */
    public function index()
    {
        $cars = Car::orderBy('model')->paginate(10);

        return CarResource::collection($cars)->response()->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Cadastrar carro.
     */
    public function store(StoreCarRequest $request)
    {
        try {
            $car = Car::create($request->all());

            return response()->json(["message" => "Carro cadastrado com sucesso."], JsonResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Buscar carro.
     */
    public function show($car)
    {
        try {
            $cars = Car::findOrFail($car);

            return new CarResource($cars)->response()->setStatusCode(JsonResponse::HTTP_OK);

        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json(["message" => "Carro não encontrado."], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualizar carro.
     */
    public function update(UpdateCarRequest $request, $car)
    {
        try {
            $car = Car::findOrFail($car);

            $car->update($request->all());

            return response()->json(["message" => "Carro atualizado com sucesso."], JsonResponse::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json(["message" => "Erro, carro não encontrado."], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Deletar Carro.
     */
    public function destroy($car)
    {
        try {
            $car = Car::findOrFail(intval($car));

            $car->deleteOrFail();

            return response()->json(["message" => "Carro excluído com sucesso."], JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());

            return response()->json(["message" => "Erro ao tentar excluír o carro."], JsonResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
