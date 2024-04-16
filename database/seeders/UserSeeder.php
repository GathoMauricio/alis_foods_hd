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
        User::truncate();
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
        $mauricio->assignRole(['Super usuario', 'Administrador', 'Gerente', 'Técnico']);

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
        $rene->assignRole(['Super usuario', 'Administrador', 'Gerente', 'Técnico']);

        #Usuarios finales
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Jesús',
                'apaterno' => 'Salas',
                'amaterno' => '',
                'email' => 'jsalas@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('vQo575'),
            ]
        );
        $user->assignRole(['Técnico', 'Administrador']);
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Oscar',
                'apaterno' => 'Cabello',
                'amaterno' => '',
                'email' => 'ocabello@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('523BHy'),
            ]
        );
        $user->assignRole(['Técnico', 'Administrador']);
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Cruz',
                'apaterno' => 'Casillas',
                'amaterno' => 'Medrano',
                'email' => 'ccasillas@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('8Bf15i'),
            ]
        );
        $user->assignRole(['Técnico', 'Administrador']);
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Karina',
                'apaterno' => 'Herrera',
                'amaterno' => '',
                'email' => 'kherrera@alisfoods.com',
                'telefono' => '',
                'password' => bcrypt('840wED'),
            ]
        );
        $user->assignRole(['Técnico']);
        // $user = User::create(
        //     [
        //         'sucursal_id' => null,
        //         'categoria_id' => 1,
        //         'name' => 'Juan Carlos',
        //         'apaterno' => 'García',
        //         'amaterno' => '',
        //         'email' => 'jcgarcia@alisfoods.com',
        //         'telefono' => '',
        //         'password' => bcrypt('d8aC25'),
        //     ]
        // );
        // $user->assignRole(['Técnico']);
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Eduardo',
                'apaterno' => 'Almanza',
                'amaterno' => '',
                'email' => 'ealmanza@alisfoods.com',
                'telefono' => '',
                'password' => bcrypt('48Z4ph'),
            ]
        );
        $user->assignRole(['Técnico']);
        $user = User::create(
            [
                'sucursal_id' => null,
                'categoria_id' => 1,
                'name' => 'Yahir',
                'apaterno' => 'Martínez',
                'amaterno' => '',
                'email' => 'ymartinez@alisfoods.com',
                'telefono' => '',
                'password' => bcrypt('594Gjd'),
            ]
        );
        $user->assignRole(['Técnico']);
        #GERENTES
        $user = User::create(
            [
                'sucursal_id' => 1,
                'categoria_id' => null,
                'name' => 'Aeropuerto',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'aeropuerto@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('8H12z8'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 2,
                'categoria_id' => null,
                'name' => 'Arcadia',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'arcadia@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('T9I4m9'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 3,
                'categoria_id' => null,
                'name' => 'Centro',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'centromty@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('wMd810'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 4,
                'categoria_id' => null,
                'name' => 'Chapultepec',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'chapultepec@lasalitas.com ',
                'telefono' => '',
                'password' => bcrypt('Zi60Y8'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 5,
                'categoria_id' => null,
                'name' => 'Clavería',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_claveria@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('19c6B9'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 6,
                'categoria_id' => null,
                'name' => 'Concordia',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'concordia@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('yY4961'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 7,
                'categoria_id' => null,
                'name' => 'Condesa',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_condesa@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('F5w92n'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 8,
                'categoria_id' => null,
                'name' => 'Cosmopol',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_cosmopol@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('o8S00x'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 9,
                'categoria_id' => null,
                'name' => 'Cumbres',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'cumbres@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('5EW2z6'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 10,
                'categoria_id' => null,
                'name' => 'Galerías Toluca',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'galeriastoluca@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('0Z2w06'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 11,
                'categoria_id' => null,
                'name' => 'Grijalva',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'grijalva@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('jP95i7'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 12,
                'categoria_id' => null,
                'name' => 'Lindavista',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'lindavista@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('89tU26'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 13,
                'categoria_id' => null,
                'name' => 'Lomas Estrella',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_lomasestrella@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('1Xpx40'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 14,
                'categoria_id' => null,
                'name' => 'MAQ',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_maq@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('1k9D4t'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 15,
                'categoria_id' => null,
                'name' => 'Marina Nacional',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_marinanacional@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('n1yY03'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 16,
                'categoria_id' => null,
                'name' => 'Metepec',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'galeriasmetepec@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('77cV1f'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 17,
                'categoria_id' => null,
                'name' => 'Nuevo Sur',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'nuevosur@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('91lQe6'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 18,
                'categoria_id' => null,
                'name' => 'Oblatos',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'gdl_oblatos@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('33Vs34'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 19,
                'categoria_id' => null,
                'name' => 'Paseo 727',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'paseo727@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('6B95kd'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 20,
                'categoria_id' => null,
                'name' => 'Paseo La Fe',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'paseolafe@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('D5910y'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 21,
                'categoria_id' => null,
                'name' => 'Patio Revolución',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_loreto@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('wF2e36'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 22,
                'categoria_id' => null,
                'name' => 'Plaza Citadel',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'plazacitadel@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('7e40A4'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 23,
                'categoria_id' => null,
                'name' => 'Plaza Cumbres',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'plazacumbres@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('94g8nE'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 24,
                'categoria_id' => null,
                'name' => 'Plaza Real',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'plazareal@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('4h6Ko4'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 25,
                'categoria_id' => null,
                'name' => 'Portal Vallejo',
                'apaterno' => '',
                'amaterno' => 'Gerencia',
                'email' => 'mex_portalvallejo@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('503GGo'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 26,
                'categoria_id' => null,
                'name' => 'Roble Universidad',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'robleuniversidad@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('7fcR42'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 27,
                'categoria_id' => null,
                'name' => 'Santa Catarina',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'santacatarina@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('BpF366'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 28,
                'categoria_id' => null,
                'name' => 'Satelite',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'satelitemty@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('p189Iz'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 29,
                'categoria_id' => null,
                'name' => 'Sendero',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'sendero@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('65Kv8J'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 30,
                'categoria_id' => null,
                'name' => 'Sendero La Fe',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'senderolafe@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('J14rL0'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 31,
                'categoria_id' => null,
                'name' => 'Sendero Lincoln',
                'apaterno' => '',
                'amaterno' => 'Gerencia',
                'email' => 'lincoln@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('51nMf4'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 32,
                'categoria_id' => null,
                'name' => 'Sendero Toluca',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'senderotoluca@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('41N1Gx'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 33,
                'categoria_id' => null,
                'name' => 'Valle Oriente',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'valleoriente@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('4h532Q'),
            ]
        );
        $user->assignRole(['Gerente']);
        $user = User::create(
            [
                'sucursal_id' => 34,
                'categoria_id' => null,
                'name' => 'Vía Vallejo',
                'apaterno' => 'Gerencia',
                'amaterno' => 'Gerencia',
                'email' => 'mex_viavallejo@lasalitas.com',
                'telefono' => '',
                'password' => bcrypt('F241Jz'),
            ]
        );
        $user->assignRole(['Gerente']);
    }
}
