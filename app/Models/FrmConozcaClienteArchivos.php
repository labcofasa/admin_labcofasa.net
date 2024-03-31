<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClienteArchivos extends Model
{
    use HasFactory;

    protected $table = "frm_conozca_cliente_archivos";
    public $timestamps = false;
    protected $fillable = [
        'nombre_archivo',
    ];

    public function conozcaClienteArchivos()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
