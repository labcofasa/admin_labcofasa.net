<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormConozcaClienteMiembros extends Model
{
    use HasFactory;

    protected $table = 'forms_conozca_cliente_miembros';
    protected $fillable = [
        'nombre_miembro', 
        'nacionalidad_miembro', 
        'numero_identidad_miembro', 
        'cargo_miembro'
    ];

    public function conozcaClienteMiembros()
    {
        return $this->belongsTo(FormConozcaCliente::class, 'forms_conozca_cliente_id');
    }
}
