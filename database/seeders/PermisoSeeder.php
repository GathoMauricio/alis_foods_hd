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

        Permission::create(['name' => 'modulo_usuarios']);
        Permission::create(['name' => 'detalle_usuarios']);
        Permission::create(['name' => 'crear_usuarios']);
        Permission::create(['name' => 'editar_usuarios']);
        Permission::create(['name' => 'eliminar_usuarios']);

        //Asignar permisos al super usuario
        $super_usuario->givePermissionTo('modulo_roles_permisos');

        $super_usuario->givePermissionTo('modulo_usuarios');
        $super_usuario->givePermissionTo('detalle_usuarios');
        $super_usuario->givePermissionTo('crear_usuarios');
        $super_usuario->givePermissionTo('editar_usuarios');
        $super_usuario->givePermissionTo('eliminar_usuarios');
    }
}
