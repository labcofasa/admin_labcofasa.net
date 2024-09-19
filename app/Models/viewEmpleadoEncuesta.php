<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class viewEmpleadoEncuesta extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_ENCUESTAS'; // Conexión a la base de datos
    protected $table = 'vEmpleadosEvaluacionT'; // Vista para obtener datos
    public $timestamps = false;
}
