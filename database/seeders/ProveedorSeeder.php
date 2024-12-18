<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'Proveedor de Prueba',
            'ubicacion' => 'Ubicación de Prueba',
            'NIT' => '123456789', // Asegúrate de que este NIT sea único en tu base de datos
        ]);
    }
}
