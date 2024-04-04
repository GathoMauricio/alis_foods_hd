<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::truncate();
        Categoria::create(['nombre' => 'TECNOLOGÍAS DE INFORMACIÓN']);
        Categoria::create(['nombre' => 'CATEGORÍA TEST UNO']);
        Categoria::create(['nombre' => 'CATEGORÍA TEST DOS']);
    }
}
