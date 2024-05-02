<?php

namespace App\Models\Empleos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    use HasFactory;

    protected $table = 'candidatos';
    public $timestamps = false;
    protected $dates = ['fecha_creacion', 'fecha_modificacion'];

    protected $fillable = [
        'fecha_creacion',
        'fecha_modificacion'
    ];

    public function vacante()
    {
        return $this->belongsTo(Vacante::class, 'id_vacante');
    }
}
