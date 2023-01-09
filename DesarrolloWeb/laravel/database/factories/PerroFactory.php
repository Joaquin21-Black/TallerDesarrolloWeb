<?php

namespace Database\Factories;

use App\Models\Perro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class PerroFactory extends Factory
{
    protected $model = Perro::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'url_foto' => Http::get('https://dog.ceo/api/breeds/image/random')['message'],
            'descripcion' => $this->faker->sentence,
        ];
    }
}