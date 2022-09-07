<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $role1 = Role::create(['name'=>'Recepcionista']);
        // $role2 = Role::create(['name'=>'Auxiliar']);
        // $role3 = Role::create(['name'=>'Jefe']);
        // $role4 = Role::create(['name'=>'Administrador']);

        // Permission::create(['name'=>'panel.home'])->syncRoles([$role1,$role2,$role3,$role4]);
        // Permission::create(['name'=>'panel.proveedores'])->syncRoles([$role1,$role2,$role3,$role4]);
        // Permission::create(['name'=>'panel.usuarios'])->syncRoles([$role4]);

        Permission::create(['name'=>'panel.categoria_articulos','description'=>'Ver panel de categoría de artículos.']);
        Permission::create(['name'=>'panel.articulos','description'=>'Ver panel de artículos.']);
        Permission::create(['name'=>'panel.servicios','description'=>'Ver panel de servicios.']);
        Permission::create(['name'=>'panel.entradas','description'=>'Ver panel de entradas.']);
        Permission::create(['name'=>'panel.salidas','description'=>'Ver panel de salidas.']);
        Permission::create(['name'=>'panel.consultas','description'=>'Ver panel de consultas y reportes.']);
        
        Permission::create(['name'=>'operaciones.proveedores','description'=>'Operaciones en panel de proveedores (Alta, Modificación y Baja).']);
        Permission::create(['name'=>'operaciones.categoria_articulos','description'=>'Operaciones en panel de categoría de artículos (Alta, Modificación y Baja).']);
        Permission::create(['name'=>'operaciones.aticulos','description'=>'Operaciones en panel de artículos (Alta, Modificación y Baja).']);
        Permission::create(['name'=>'operaciones.servicios','description'=>'Operaciones en panel de servicios (Alta, Modificación y Baja).']);



    }
}
