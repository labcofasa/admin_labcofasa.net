<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUserName = env('ADMIN_USERNAME', 'Cofasa');
        $adminName = env('ADMIN_NAME', 'Laboratorios');
        $adminEmail = env('ADMIN_MAIL', 'informatica@labcofasa.com');
        $adminPassword = env('ADMIN_PASSWORD', 'cofa$a123');

        $user = User::create([
            'name' => $adminUserName,
            'email' => $adminEmail,
            'password' => bcrypt($adminPassword),
        ]);

        $role = Role::where('name', 'administrador')->first();

        if ($role && !$user->hasRole('administrador')) {
            $user->assignRole($role);
        }

        $perfil = new Perfil([
            'nombres' => $adminName,
            'apellidos' => $adminUserName,
        ]);

        $user->perfil()->save($perfil);
    }
}
