<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ##################CREAR ROLES #############################
        $super_usuario = Role::create(['name' => 'Super usuario']);
        $administrador = Role::create(['name' => 'Administrador']);
        $gerente_general = Role::create(['name' => 'Gerente general']);
        $gerente_turno = Role::create(['name' => 'Gerente en turno']);
        $gerente_satelital = Role::create(['name' => 'Gerente satelital']);

        #################CREAR PERMISOS############################
        Permission::create(['name' => 'modulo_roles_permisos']);

        //Usuarios
        Permission::create(['name' => 'modulo_usuarios']);
        Permission::create(['name' => 'detalle_usuarios']);
        Permission::create(['name' => 'crear_usuarios']);
        Permission::create(['name' => 'editar_usuarios']);
        Permission::create(['name' => 'eliminar_usuarios']);

        //Sucursales
        Permission::create(['name' => 'modulo_sucursales']);
        Permission::create(['name' => 'detalle_sucursales']);
        Permission::create(['name' => 'crear_sucursales']);
        Permission::create(['name' => 'editar_sucursales']);
        Permission::create(['name' => 'eliminar_sucursales']);

        #Asignar permisos al super usuario
        $super_usuario->givePermissionTo('modulo_roles_permisos');

        //Permisos Usuarios
        $super_usuario->givePermissionTo('modulo_usuarios');
        $super_usuario->givePermissionTo('detalle_usuarios');
        $super_usuario->givePermissionTo('crear_usuarios');
        $super_usuario->givePermissionTo('editar_usuarios');
        $super_usuario->givePermissionTo('eliminar_usuarios');

        //Permisos Sucursales
        $super_usuario->givePermissionTo('modulo_sucursales');
        $super_usuario->givePermissionTo('detalle_sucursales');
        $super_usuario->givePermissionTo('crear_sucursales');
        $super_usuario->givePermissionTo('editar_sucursales');
        $super_usuario->givePermissionTo('eliminar_sucursales');


        #Asignar permisos al Administrador

        //Permisos Sucursales
        $administrador->givePermissionTo('modulo_sucursales');
        $administrador->givePermissionTo('detalle_sucursales');
        $administrador->givePermissionTo('crear_sucursales');
        $administrador->givePermissionTo('editar_sucursales');
        $administrador->givePermissionTo('eliminar_sucursales');
    }
}
