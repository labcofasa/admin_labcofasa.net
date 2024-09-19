<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_ENCUESTAS';
    protected $table = 'vEmpleadoActivos';
}
