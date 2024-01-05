<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Departamento;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $columns = ['id'];
        $users = User::all($columns);

        $departamentos = [
            ['nombre' => 'Ahuachapán', 'codigo_mh' => '01', 'pais_id' => '1'],
            ['nombre' => 'Santa Ana', 'codigo_mh' => '02', 'pais_id' => '1'],
            ['nombre' => 'Sonsonate', 'codigo_mh' => '03', 'pais_id' => '1'],
            ['nombre' => 'Chalatenango', 'codigo_mh' => '04', 'pais_id' => '1'],
            ['nombre' => 'La Libertad', 'codigo_mh' => '05', 'pais_id' => '1'],
            ['nombre' => 'San Salvador', 'codigo_mh' => '06', 'pais_id' => '1'],
            ['nombre' => 'Cuscatlán', 'codigo_mh' => '07', 'pais_id' => '1'],
            ['nombre' => 'La Paz', 'codigo_mh' => '08', 'pais_id' => '1'],
            ['nombre' => 'Cabañas', 'codigo_mh' => '09', 'pais_id' => '1'],
            ['nombre' => 'San Vicente', 'codigo_mh' => '10', 'pais_id' => '1'],
            ['nombre' => 'Usulután', 'codigo_mh' => '11', 'pais_id' => '1'],
            ['nombre' => 'San Miguel', 'codigo_mh' => '12', 'pais_id' => '1'],
            ['nombre' => 'Morazán', 'codigo_mh' => '13', 'pais_id' => '1'],
            ['nombre' => 'La Unión', 'codigo_mh' => '14', 'pais_id' => '1'],
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create([
                'nombre' => $departamento['nombre'],
                'codigo_mh' => $departamento['codigo_mh'],
                'pais_id' => $departamento['pais_id'],
                'user_id' => $users->random()->id
            ]);
        }
    }
}
