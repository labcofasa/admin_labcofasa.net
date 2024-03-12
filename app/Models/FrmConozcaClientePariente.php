<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClientePariente extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_pariente';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_pariente',
        'parentesco',
        'fecha_de_creacion',
        'fecha_de_modificacion'
    ];

    public function conozcaClienteParientes()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
