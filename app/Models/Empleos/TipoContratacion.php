<?php

namespace App\Models\Empleos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContratacion extends Model
{
    use HasFactory;

    protected $table = 'tipo_contratacion';
    public $timestamps = false;
    protected $dates = ['fecha_creacion', 'fecha_modificacion'];

    protected $fillable = [
        'nombre',
        'fecha_creacion',
        'fecha_modificacion'
    ];
}
