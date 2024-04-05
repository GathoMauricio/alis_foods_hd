<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketEstatus;

class TicketEstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketEstatus::create(['id' => 1, 'nombre' => 'Abierto']);
        TicketEstatus::create(['id' => 2, 'nombre' => 'En proceso con terceros']);
        TicketEstatus::create(['id' => 3, 'nombre' => 'Proceso']);
        TicketEstatus::create(['id' => 4, 'nombre' => 'Cerrado']);
    }
}
