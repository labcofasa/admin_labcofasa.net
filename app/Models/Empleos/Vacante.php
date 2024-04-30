<?php

namespace App\Models\Empleos;

use App\Models\Departamento;
use App\Models\Empresa;
use App\Models\Municipio;
use App\Models\Pais;
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
        'requisitos',
        'beneficios',
        'fecha_vencimiento',
        'imagen',
        'fecha_creacion',
        'fecha_modificacion'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }

    public function tipoContratacion()
    {
        return $this->belongsTo(TipoContratacion::class, 'id_tipo_contratacion');
    }

    public function modalidad()
    {
        return $this->belongsTo(Modalidad::class, 'id_modalidad');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'id_pais');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'id_municipio');
    }
}
