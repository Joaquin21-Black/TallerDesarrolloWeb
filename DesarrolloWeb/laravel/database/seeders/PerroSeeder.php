<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Perro;

class PerroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perro = new Perro();

        $perro->perro_id = 1;
        $perro->nombre = "Juan";
        $perro->url_foto = "aqui va una url";
        $perro->descripcion  = "mi perro es genial";

        $perro->save();
    }
}
