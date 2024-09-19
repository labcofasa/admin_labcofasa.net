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
            // Dashboard
            ['name' => 'admin_dashboard_ver', 'descripcion' => 'Ver dashboard de estadisticas'],

            // Usuarios
            ['name' => 'admin_usuarios_ver', 'descripcion' => 'Ver página de usuarios'],
            ['name' => 'admin_usuarios_crear', 'descripcion' => 'Crear usuarios'],
            ['name' => 'admin_usuarios_editar', 'descripcion' => 'Editar usuarios'],
            ['name' => 'admin_usuarios_eliminar', 'descripcion' => 'Eliminar usuarios'],

            // Roles
            ['name' => 'admin_roles_ver', 'descripcion' => 'Ver página de roles'],
            ['name' => 'admin_roles_crear', 'descripcion' => 'Crear roles'],
            ['name' => 'admin_roles_editar', 'descripcion' => 'Editar roles'],
            ['name' => 'admin_roles_eliminar', 'descripcion' => 'Eliminar roles'],

            // Permisos
            ['name' => 'admin_permisos_ver', 'descripcion' => 'Ver página de permisos'],
            ['name' => 'admin_permisos_asignar', 'descripcion' => 'Asignar permisos'],
            ['name' => 'admin_permisos_eliminar', 'descripcion' => 'Eliminar permisos'],

            // Empresas
            ['name' => 'admin_empresas_ver', 'descripcion' => 'Ver página de empresas'],
            ['name' => 'admin_empresas_crear', 'descripcion' => 'Crear empresas'],
            ['name' => 'admin_empresas_editar', 'descripcion' => 'Editar empresas'],
            ['name' => 'admin_empresas_eliminar', 'descripcion' => 'Eliminar empresas'],

            // Entidades
            ['name' => 'admin_entidades_ver', 'descripcion' => 'Ver página de entidades'],
            ['name' => 'admin_entidades_crear', 'descripcion' => 'Crear entidades'],
            ['name' => 'admin_entidades_editar', 'descripcion' => 'Editar entidades'],
            ['name' => 'admin_entidades_eliminar', 'descripcion' => 'Eliminar entidades'],

            // Tipo de contribuyente
            ['name' => 'admin_clasificaciones_ver', 'descripcion' => 'Ver página de clasificaciones'],
            ['name' => 'admin_clasificaciones_crear', 'descripcion' => 'Crear clasificaciones'],
            ['name' => 'admin_clasificaciones_editar', 'descripcion' => 'Editar clasificaciones'],
            ['name' => 'admin_clasificaciones_eliminar', 'descripcion' => 'Eliminar clasificaciones'],

            // Actividades económicas
            ['name' => 'admin_giros_ver', 'descripcion' => 'Ver página de giros'],
            ['name' => 'admin_giros_crear', 'descripcion' => 'Crear giros'],
            ['name' => 'admin_giros_editar', 'descripcion' => 'Editar giros'],
            ['name' => 'admin_giros_eliminar', 'descripcion' => 'Eliminar giros'],

            // Paises
            ['name' => 'admin_paises_ver', 'descripcion' => 'Ver página de paises'],
            ['name' => 'admin_paises_crear', 'descripcion' => 'Crear paises'],
            ['name' => 'admin_paises_editar', 'descripcion' => 'Editar paises'],
            ['name' => 'admin_paises_eliminar', 'descripcion' => 'Eliminar paises'],

            // Departamentos
            ['name' => 'admin_departamentos_ver', 'descripcion' => 'Ver página de departamentos'],
            ['name' => 'admin_departamentos_crear', 'descripcion' => 'Crear departamentos'],
            ['name' => 'admin_departamentos_editar', 'descripcion' => 'Editar departamentos'],
            ['name' => 'admin_departamentos_eliminar', 'descripcion' => 'Eliminar departamentos'],

            // Municipios
            ['name' => 'admin_municipios_ver', 'descripcion' => 'Ver página de municipios'],
            ['name' => 'admin_municipios_crear', 'descripcion' => 'Crear municipios'],
            ['name' => 'admin_municipios_editar', 'descripcion' => 'Editar municipios'],
            ['name' => 'admin_municipios_eliminar', 'descripcion' => 'Eliminar municipios'],

            // Papelera
            ['name' => 'admin_papelera_ver', 'descripcion' => 'Ver página de papelera'],
            ['name' => 'admin_papelera_recuperar', 'descripcion' => 'Recuperar registros'],

            // Aplicaciones
            ['name' => 'admin_aplicaciones_ver', 'descripcion' => 'Ver aplicaciones'],
            ['name' => 'admin_aplicaciones_crear', 'descripcion' => 'Crear aplicaciones'],
            ['name' => 'admin_aplicaciones_editar', 'descripcion' => 'Editar aplicaciones'],
            ['name' => 'admin_aplicaciones_eliminar', 'descripcion' => 'Eliminar aplicaciones'],

            // Publicidad
            ['name' => 'admin_avisos_ver', 'descripcion' => 'Ver avisos'],
            ['name' => 'admin_avisos_crear', 'descripcion' => 'Crear avisos'],
            ['name' => 'admin_avisos_editar', 'descripcion' => 'Editar avisos'],
            ['name' => 'admin_avisos_eliminar', 'descripcion' => 'Eliminar avisos'],

            // Clientes
            ['name' => 'admin_clientes_ver', 'descripcion' => 'Ver clientes'],
            ['name' => 'admin_clientes_crear', 'descripcion' => 'Crear clientes'],
            ['name' => 'admin_clientes_editar', 'descripcion' => 'Editar clientes'],

            // Articulos
            ['name' => 'admin_articulos_ver', 'descripcion' => 'Ver articulos'],
            ['name' => 'admin_articulos_crear', 'descripcion' => 'Crear articulos'],
            ['name' => 'admin_articulos_editar', 'descripcion' => 'Editar articulos'],
            ['name' => 'admin_articulos_eliminar', 'descripcion' => 'Eliminar articulos'],

            // Formularios
            ['name' => 'admin_formularios_ver', 'descripcion' => 'Ver formularios'],
            ['name' => 'admin_formularios_ver_cliente', 'descripcion' => 'Ver formulario de clientes'],
            ['name' => 'admin_formularios_ver_proveedor', 'descripcion' => 'Ver formulario de proveedores'],
            ['name' => 'admin_formularios_crear', 'descripcion' => 'Crear formularios'],
            ['name' => 'admin_formularios_editar', 'descripcion' => 'Editar formularios'],
            ['name' => 'admin_formularios_eliminar', 'descripcion' => 'Eliminar formularios'],

            // Candidatos
            ['name' => 'admin_candidatos_ver', 'descripcion' => 'Ver candidatos'],
            ['name' => 'admin_candidatos_crear', 'descripcion' => 'Crear candidatos'],
            ['name' => 'admin_candidatos_editar', 'descripcion' => 'Editar candidatos'],
            ['name' => 'admin_candidatos_eliminar', 'descripcion' => 'Eliminar candidatos'],

            // Vacantes
            ['name' => 'admin_vacantes_ver', 'descripcion' => 'Ver vacantes'],
            ['name' => 'admin_vacantes_crear', 'descripcion' => 'Crear vacantes'],
            ['name' => 'admin_vacantes_editar', 'descripcion' => 'Editar vacantes'],
            ['name' => 'admin_vacantes_eliminar', 'descripcion' => 'Eliminar vacantes'],

            //Encuestas
            ['name' => 'admin_encuestas_ver', 'descripcion' => 'Ver encuestas'],
            ['name' => 'admin_encuestas_crear', 'descripcion' => 'Crear encuestas'],
            ['name' => 'admin_encuestas_editar', 'descripcion' => 'Editar encuestas'],
            ['name' => 'admin_encuestas_eliminar', 'descripcion' => 'Eliminar encuestas'],
        ];

        foreach ($permissions as $permissionData) {
            $permission = Permission::firstOrCreate(['name' => $permissionData['name']]);
            $permission->update(['descripcion' => $permissionData['descripcion']]);
            $permission->assignRole([$admin]);
        }
        ;
    }
}
