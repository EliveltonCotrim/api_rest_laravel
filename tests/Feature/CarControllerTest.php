<?php

use App\Models\Car;

it('must list the cars', function () {
    Car::factory()->count(10)->create();

    $response = $this->getJson('/api/cars');

    $response->assertStatus(200)
        ->assertJsonCount(10, 'data');
});

it('must register a car', function () {
    $data = [
        'brand' => 'Toyota',
        'model' => 'Corolla',
        'year' => 2022
    ];

    $response = $this->postJson('/api/cars', $data);

    $response->assertStatus(201)
        ->assertJson(['message' => 'Carro cadastrado com sucesso.']);

    $this->assertDatabaseHas('cars', $data);
});

it('must get a car', function () {
    $car = Car::factory()->create();

    $response = $this->getJson("/api/cars/{$car->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'id' => $car->id,
            'model' => $car->model,
            'brand' => $car->brand,
            'year' => $car->year,
            'created_at' => $car->created_at
        ]);
});

it('must update a car', function () {
    $car = Car::factory()->create();

    $updateData = [
        'model' => fake()->words(2, true),
        'brand' => fake()->company,
        'year' => fake()->year()
    ];

    $response = $this->putJson("/api/cars/{$car->id}", $updateData);

    $response->assertStatus(201)
             ->assertJson(['message' => 'Carro atualizado com sucesso.']);

    $this->assertDatabaseHas('cars', $updateData);
});

it('must delete a car', function () {
    $car = Car::factory()->create();

    $response = $this->deleteJson("/api/cars/{$car->id}");

    $response->assertStatus(200)
             ->assertJson(['message' => 'Carro excluído com sucesso.']);

    $this->assertSoftDeleted('cars', ['id' => $car->id]);
});

it('should return an error when searching for a non-existent car', function () {
    $response = $this->getJson('/api/cars/99999');

    $response->assertStatus(404)
             ->assertJson(['message' => 'Carro não encontrado.']);
});
