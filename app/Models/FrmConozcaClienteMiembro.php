<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClienteMiembro extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_miembro';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_miembro',
        'nacionalidad_miembro',
        'numero_identidad_miembro',
        'cargo_miembro',
        'fecha_de_creacion',
        'fecha_de_modificacion'
    ];

    public function conozcaClienteMiembros()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
