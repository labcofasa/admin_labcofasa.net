<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Entidad;
use App\Models\User; // Asegúrate de importar el modelo User

class EntidadSeeder extends Seeder
{
    public function run(): void
    {
        $columns = ['id'];
        $users = User::all($columns);

        $entidades = [
            ['nombre' => 'Sin entidad', 'descripcion' => 'Sin descripción'],
            ['nombre' => 'S.A. de C.V.', 'descripcion' => 'Sociedad Anónima de Capital Variable'],
            ['nombre' => 'S.R.L.', 'descripcion' => 'Sociedad de Responsabilidad Limitada'],
        ];

        foreach ($entidades as $entidad) {
            Entidad::create([
                'nombre' => $entidad['nombre'],
                'descripcion' => $entidad['descripcion'],
                'user_id' => $users->random()->id
            ]);
        }
    }
}
