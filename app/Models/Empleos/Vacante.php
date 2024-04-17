<?php

namespace App\Models\Empleos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $table = 'vacantes';
    public $timestamps = false;
    protected $dates = ['fecha_creacion', 'fecha_modificacion', 'fecha_vencimiento'];

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_vencimiento',
        'imagen',
        'fecha_creacion',
        'fecha_modificacion'
    ];
}
