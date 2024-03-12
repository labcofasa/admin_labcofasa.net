<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClienteSocio extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_socio';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_socio',
        'porcentaje_participacion_socio',
        'fecha_de_creacion',
        'fecha_de_modificacion'
    ];


    public function conozcaClienteSocios()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
