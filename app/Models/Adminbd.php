<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adminbd extends Model
{
    use HasFactory;
    // Nombre de la tabla en BD2
    protected $table = 'usuarios';

    // Indica qué conexión usar
    protected $connection = 'DB_CONNECTION_ADMIN';
}
