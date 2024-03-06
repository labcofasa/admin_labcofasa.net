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
            //El SALVADOR
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
            //GUATEMALA
            ['nombre' => 'Guatemala', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'El Progreso', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Sacatepéquez', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Chimaltenango', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Escuintla', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Santa Rosa', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Sololá', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Totonicapán', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Quetzaltenango', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Suchitepéquez', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Retalhuleu', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'San Marcos', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Huehuetenango', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Quiché', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Baja Verapaz', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Alta Verapaz', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Petén', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Izabal', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Zacapa', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Chiquimula', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Jalapa', 'codigo_mh' => NULL, 'pais_id' => '2'],
            ['nombre' => 'Jutiapa', 'codigo_mh' => NULL, 'pais_id' => '2'],
            //BELICE
            ['nombre' => 'Belize', 'codigo_mh' => NULL, 'pais_id' => '3'],
            ['nombre' => 'Cayo', 'codigo_mh' => NULL, 'pais_id' => '3'],
            ['nombre' => 'Corozal', 'codigo_mh' => NULL, 'pais_id' => '3'],
            ['nombre' => 'Orange Walk', 'codigo_mh' => NULL, 'pais_id' => '3'],
            ['nombre' => 'Stann Creek', 'codigo_mh' => NULL, 'pais_id' => '3'],
            ['nombre' => 'Toledo', 'codigo_mh' => NULL, 'pais_id' => '3'],
            //HONDURAS
            ['nombre' => 'Atlántida', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Colón', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Comayagua', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Copán', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Cortés', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Choluteca', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'El Paraíso', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Francisco Morazán', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Gracias a Dios', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Intibucá', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Islas de la Bahía', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'La Paz', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Lempira', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Ocotepeque', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Olancho', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Santa Bárbara', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Valle', 'codigo_mh' => NULL, 'pais_id' => '4'],
            ['nombre' => 'Yoro', 'codigo_mh' => NULL, 'pais_id' => '4'],
            //NICARAGUA
            ['nombre' => 'Boaco', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Carazo', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Chinandega', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Chontales', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Estelí', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Granada', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Jinotega', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'León', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Madriz', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Managua', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Masaya', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Matagalpa', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Nueva Segovia', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Río San Juan', 'codigo_mh' => NULL, 'pais_id' => '5'],
            ['nombre' => 'Rivas', 'codigo_mh' => NULL, 'pais_id' => '5'],
            //COSTA RICA
            ['nombre' => 'San José', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Alajuela', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Cartago', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Heredia', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Guanacaste', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Puntarenas', 'codigo_mh' => NULL, 'pais_id' => '6'],
            ['nombre' => 'Limón', 'codigo_mh' => NULL, 'pais_id' => '6'],
            //PANAMA
            ['nombre' => 'Bocas del Toro', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Coclé', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Colón', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Chiriquí', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Darién', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Herrera', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Los Santos', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Panamá', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Veraguas', 'codigo_mh' => NULL, 'pais_id' => '7'],
            ['nombre' => 'Panamá Oeste', 'codigo_mh' => NULL, 'pais_id' => '7'],
            //MEXICO
            ['nombre' => 'Aguascalientes', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Baja California', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Baja California Sur', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Campeche', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Chiapas', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Chihuahua', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Coahuila', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Colima', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Durango', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Guanajuato', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Guerrero', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Hidalgo', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Jalisco', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'México', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Michoacán', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Morelos', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Nayarit', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Nuevo León', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Oaxaca', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Puebla', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Querétaro', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Quintana Roo', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'San Luis Potosí', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Sinaloa', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Sonora', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Tabasco', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Tamaulipas', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Tlaxcala', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Veracruz', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Yucatán', 'codigo_mh' => NULL, 'pais_id' => '8'],
            ['nombre' => 'Zacatecas', 'codigo_mh' => NULL, 'pais_id' => '8'],
            //REPUBLICA DOMINICANA
            ['nombre' => 'Distrito Nacional', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Azua', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Bahoruco', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Barahona', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Dajabón', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Duarte', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Elías Piña', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'El Seibo', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Espaillat', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Hato Mayor', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Independencia', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'La Altagracia', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'La Romana', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'La Vega', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'María Trinidad Sánchez', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Monseñor Nouel', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Monte Cristi', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Monte Plata', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Pedernales', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Peravia', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Puerto Plata', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Samaná', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'San Cristóbal', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'San José de Ocoa', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'San Juan', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'San Pedro de Macorís', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Sánchez Ramírez', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Santiago', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Santiago Rodríguez', 'codigo_mh' => NULL, 'pais_id' => '9'],
            ['nombre' => 'Valverde', 'codigo_mh' => NULL, 'pais_id' => '9'],
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
