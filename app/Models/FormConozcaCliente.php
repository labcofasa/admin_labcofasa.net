<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormConozcaCliente extends Model
{
    use HasFactory;

    protected $table = 'forms_conozca_cliente';

    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_de_nacimiento',
        'nacionalidad',
        'profesion_u_oficicio',
        'tipo_de_documento',
        'numero_de_documento',
        'fecha_de_vencimiento',
        'registro_iva_nrc',
        'email',
        'telefono',
        'fecha_de_nombramiento',
        'direccion',
        'nombre_comercial',
        'nacionalidad_persona_juridica',
        'numero_de_nit',
        'fecha_de_constitucion',
        'registro_nrc_persona_juridica',
        'telefono_persona_juridica',
        'sitio_web',
        'numero_de_fax',
        'direccion_persona_juridica',
        'fecha_de_creacion',
        'fecha_de_modificacion',
    ];

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class);
    }

    public function giro()
    {
        return $this->belongsTo(Giro::class);
    }

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

    public function conozcaClienteAccionistas()
    {
        return $this->hasMany(RedSocial::class, 'forms_conozca_cliente_id');

    }
}
