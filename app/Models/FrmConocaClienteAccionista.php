<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConocaClienteAccionista extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_accionista';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_accionista',
        'nacionalidad_accionista',
        'numero_identidad_accionista',
        'porcentaje_participacion_accionista',
        'fecha_de_creacion',
        'fecha_de_modificacion'
    ];

    public function conozcaClienteAccionistas()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
