<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClientePolitico extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_politico';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_politico',
        'nombre_cargo_politico',
        'fecha_desde_politico',
        'fecha_hasta_politico',
        'nombre_cliente_politico',
        'porcentaje_participacion_politico',
        'fuente_ingreso',
        'monto_mensual',
        'fecha_de_creacion',
        'fecha_de_modificacion'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function conozcaClientePoliticos()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
