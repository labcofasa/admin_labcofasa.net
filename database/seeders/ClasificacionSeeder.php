<?php

namespace Database\Seeders;

use App\Models\Clasificacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $columns = ['id'];
        $users = User::all($columns);

        $clasificaciones = [
            ['nombre' => 'Grande', 'codigo' => '1'],
            ['nombre' => 'Mediana', 'codigo' => '2'],
            ['nombre' => 'Pequeña', 'codigo' => '3'],
        ];

        foreach ($clasificaciones as $clasificacion) {
            Clasificacion::create([
                'nombre' => $clasificacion['nombre'],
                'codigo' => $clasificacion['codigo'],
                'user_id' => $users->random()->id
            ]);
        }
    }
}
