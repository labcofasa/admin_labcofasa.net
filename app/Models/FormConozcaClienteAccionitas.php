<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormConozcaClienteAccionitas extends Model
{
    use HasFactory;

    protected $table = 'forms_conozca_cliente_accionistas';
    protected $fillable = ['nombre', 'nacionalidad', 'numero_identidad', 'porcentaje_participacion'];

    public function conozcaCliente()
    {
        return $this->belongsTo(FormConozcaCliente::class, 'conozca_cliente_id');
    }
}
