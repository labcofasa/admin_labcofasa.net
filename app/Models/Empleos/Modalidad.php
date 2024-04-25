<?php

namespace App\Models\Empleos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;

    protected $table = 'modalidades';
    public $timestamps = false;
    protected $dates = ['fecha_creacion', 'fecha_modificacion'];

    protected $fillable = [
        'nombre_modalidad',
        'fecha_creacion',
        'fecha_modificacion'
    ];
}
