<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaCliente extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'tipo',
        'tipo_persona',
        'estado',
        'nombre',
        'apellido',
        'fecha_de_nacimiento',
        'nacionalidad',
        'profesion_u_oficio',
        'tipo_de_documento',
        'numero_de_documento',
        'fecha_de_vencimiento',
        'registro_iva_nrc',
        'email',
        'telefono',
        'fecha_de_nombramiento',
        'direccion',
        'cargo_publico',
        'familiar_publico',
        'documento_identidad_persona_natural',
        'documento_tarjeta_iva_persona_natural',
        'documento_nit_persona_natural',
        'documento_domicilio_persona_natural',
        'documento_dnm_persona_natural',
        'documento_identificacion_representante',
        'documento_nit_representante',
        'documento_credencial_representante',
        'documento_matricula_juridico',
        'documento_acuerdo_juridico',
        'documento_nit_juridico',
        'documento_iva_juridico',
        'documento_domicilio_juridico',
        'documento_dnm_juridico',
        'formulario_firmado',
        'direccion_ip',
        'fecha_de_creacion',
        'fecha_de_modificacion'
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

    public function conozcaClienteJuridico()
    {
        return $this->hasMany(FrmConozcaClienteJuridico::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClienteAccionistas()
    {
        return $this->hasMany(FrmConocaClienteAccionista::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClienteMiembros()
    {
        return $this->hasMany(FrmConozcaClienteMiembro::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClientePoliticos()
    {
        return $this->hasMany(FrmConozcaClientePolitico::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClienteParientes()
    {
        return $this->hasMany(FrmConozcaClientePariente::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClienteSocios()
    {
        return $this->hasMany(FrmConozcaClienteSocio::class, 'frm_conozca_cliente_id');
    }

    public function conozcaClienteArchivos()
    {
        return $this->hasMany(FrmConozcaClienteArchivos::class, 'frm_conozca_cliente_id');
    }
}
