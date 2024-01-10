<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicaciones extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_aplicacion', 'imagen_aplicacion', 'enlace_aplicacion'];
}
