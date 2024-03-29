<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sucursal;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sucursal::truncate();
        Sucursal::create(['nombre' => 'Aeropuerto', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Arcadia', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Centro', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Chapultepec', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Clavería', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Concordia', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Condesa', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Cosmopol', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Cumbres', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Galerías Toluca', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Grijalva', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Lindavista', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Lomas Estrella', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'MAQ (Miguel Ángel de Quevedo)', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Marina Nacional', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Metepec', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Nuevo Sur', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Oblatos', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Paseo 727', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Paseo la Fe', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Patio Revolución', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Plaza Citadel', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Plaza Cumbres', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Plaza Real', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Portal Vallejo', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Roble Universidad', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Santa Catarina', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Satélite', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Sendero', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Sendero la Fe', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Sendero Lincoln', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Sendero Toluca', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Valle Oriente', 'descripcion' => 'Sin descripción']);
        Sucursal::create(['nombre' => 'Vía Vallejo', 'descripcion' => 'Sin descripción']);
    }
}
