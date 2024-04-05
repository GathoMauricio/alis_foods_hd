<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TicketEstatusSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(UserSeeder::class);
    }
}
