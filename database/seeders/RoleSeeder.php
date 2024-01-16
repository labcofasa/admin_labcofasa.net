<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoles();
        $this->createPermissions();
    }

    private function createRoles(): void
    {
        Role::firstOrCreate(['name' => 'administrador']);
    }

    private function createPermissions(): void
    {
        $admin = Role::findOrCreate('administrador');

        $permissions = [
            ['name' => 'admin_usuarios_ver', 'descripcion' => 'Ver página de usuarios'],
            ['name' => 'admin_usuarios_crear', 'descripcion' => 'Crear usuarios'],
            ['name' => 'admin_usuarios_editar', 'descripcion' => 'Editar usuarios'],
            ['name' => 'admin_usuarios_eliminar', 'descripcion' => 'Eliminar usuarios'],

            ['name' => 'admin_roles_ver', 'descripcion' => 'Ver página de roles'],
            ['name' => 'admin_roles_crear', 'descripcion' => 'Crear roles'],
            ['name' => 'admin_roles_editar', 'descripcion' => 'Editar roles'],
            ['name' => 'admin_roles_eliminar', 'descripcion' => 'Eliminar roles'],

            ['name' => 'admin_permisos_ver', 'descripcion' => 'Ver página de permisos'],
            ['name' => 'admin_permisos_crear', 'descripcion' => 'Crear permisos'],
            ['name' => 'admin_permisos_editar', 'descripcion' => 'Editar permisos'],
            ['name' => 'admin_permisos_eliminar', 'descripcion' => 'Eliminar permisos'],

            ['name' => 'admin_empresas_ver', 'descripcion' => 'Ver página de empresas'],
            ['name' => 'admin_empresas_crear', 'descripcion' => 'Crear empresas'],
            ['name' => 'admin_empresas_editar', 'descripcion' => 'Editar empresas'],
            ['name' => 'admin_empresas_eliminar', 'descripcion' => 'Eliminar empresas'],

            ['name' => 'admin_entidades_ver', 'descripcion' => 'Ver página de entidades'],
            ['name' => 'admin_entidades_crear', 'descripcion' => 'Crear entidades'],
            ['name' => 'admin_entidades_editar', 'descripcion' => 'Editar entidades'],
            ['name' => 'admin_entidades_eliminar', 'descripcion' => 'Eliminar entidades'],

            ['name' => 'admin_clasificaciones_ver', 'descripcion' => 'Ver página de clasificaciones'],
            ['name' => 'admin_clasificaciones_crear', 'descripcion' => 'Crear clasificaciones'],
            ['name' => 'admin_clasificaciones_editar', 'descripcion' => 'Editar clasificaciones'],
            ['name' => 'admin_clasificaciones_eliminar', 'descripcion' => 'Eliminar clasificaciones'],

            ['name' => 'admin_giros_ver', 'descripcion' => 'Ver página de giros'],
            ['name' => 'admin_giros_crear', 'descripcion' => 'Crear giros'],
            ['name' => 'admin_giros_editar', 'descripcion' => 'Editar giros'],
            ['name' => 'admin_giros_eliminar', 'descripcion' => 'Eliminar giros'],

            ['name' => 'admin_paises_ver', 'descripcion' => 'Ver página de paises'],
            ['name' => 'admin_paises_crear', 'descripcion' => 'Crear paises'],
            ['name' => 'admin_paises_editar', 'descripcion' => 'Editar paises'],
            ['name' => 'admin_paises_eliminar', 'descripcion' => 'Eliminar paises'],

            ['name' => 'admin_departamentos_ver', 'descripcion' => 'Ver página de departamentos'],
            ['name' => 'admin_departamentos_crear', 'descripcion' => 'Crear departamentos'],
            ['name' => 'admin_departamentos_editar', 'descripcion' => 'Editar departamentos'],
            ['name' => 'admin_departamentos_eliminar', 'descripcion' => 'Eliminar departamentos'],

            ['name' => 'admin_municipios_ver', 'descripcion' => 'Ver página de municipios'],
            ['name' => 'admin_municipios_crear', 'descripcion' => 'Crear municipios'],
            ['name' => 'admin_municipios_editar', 'descripcion' => 'Editar municipios'],
            ['name' => 'admin_municipios_eliminar', 'descripcion' => 'Eliminar municipios'],

            ['name' => 'admin_papelera_ver', 'descripcion' => 'Ver página de papelera'],
            ['name' => 'admin_papelera_recuperar', 'descripcion' => 'Recuperar registros'],

            ['name' => 'admin_ver_aplicaciones', 'descripcion' => 'Ver aplicaciones'],
        ];

        foreach ($permissions as $permissionData) {
            $permission = Permission::firstOrCreate(['name' => $permissionData['name']]);
            $permission->update(['descripcion' => $permissionData['descripcion']]);
            $permission->assignRole([$admin]);
        };
    }
}
