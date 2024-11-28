<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolProgramadorTrabajosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programador_trabajos = Role::create(['name' => 'programador de trabajos']);
        $programador_trabajos->givePermissionTo('crear_tickets');
    }
}
