<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pais;

class PaisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $columns = ['id'];
        $users = User::all($columns);

        $paises = [
            ['nombre' => 'El Salvador', 'codigo_mh' => '9300', 'codigo_iso' => 'SV'],
            ['nombre' => 'Guatemala', 'codigo_mh' => '9483', 'codigo_iso' => 'GT'],
            ['nombre' => 'Belice', 'codigo_mh' => '9349', 'codigo_iso' => 'BZ'],
            ['nombre' => 'Honduras', 'codigo_mh' => '9501', 'codigo_iso' => 'HN'],
            ['nombre' => 'Nicaragua', 'codigo_mh' => '9615', 'codigo_iso' => 'NI'],
            ['nombre' => 'Costa Rica', 'codigo_mh' => '9411', 'codigo_iso' => 'CR'],
            ['nombre' => 'Panamá', 'codigo_mh' => '9642', 'codigo_iso' => 'PA'],
            ['nombre' => 'México', 'codigo_mh' => '9600', 'codigo_iso' => 'MX'],
            ['nombre' => 'Dominicana Rep', 'codigo_mh' => '9441', 'codigo_iso' => 'DO'],
        ];

        foreach ($paises as $pais) {
            Pais::create([
                'nombre' => $pais['nombre'],
                'codigo_mh' => $pais['codigo_mh'],
                'codigo_iso' => $pais['codigo_iso'],
                'user_id' => $users->random()->id
            ]);
        }
    }
}
