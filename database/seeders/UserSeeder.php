<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mauricio = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => null,
                'name' => 'Mauricio',
                'apaterno' => 'J.',
                'amaterno' => 'Soriano',
                'email' => 'mauricio2769@gmail.com',
                'telefono' => '5525233295',
                'password' => bcrypt('12345678'),
            ]
        );
        $mauricio->assignRole(['Super usuario']);

        $rene = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => null,
                'name' => 'René',
                'apaterno' => 'Ortuño',
                'amaterno' => 'Mendoza',
                'email' => 'rortuno@dotredes.com',
                'telefono' => '000000000',
                'password' => bcrypt('12345678'),
            ]
        );
        $rene->assignRole(['Super usuario']);
    }
}
