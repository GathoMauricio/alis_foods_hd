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
        TicketEstatus::truncate();
        TicketEstatus::create(['id' => 1, 'nombre' => 'Creado']);
        TicketEstatus::create(['id' => 2, 'nombre' => 'En proceso con terceros']);
        TicketEstatus::create(['id' => 3, 'nombre' => 'En proceso']);
        TicketEstatus::create(['id' => 4, 'nombre' => 'Cerrado']);
        TicketEstatus::create(['id' => 5, 'nombre' => 'Finalizado']);
        TicketEstatus::create(['id' => 6, 'nombre' => 'En espera de respuesta de cliente']);
    }
}
