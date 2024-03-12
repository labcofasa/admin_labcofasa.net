<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrmConozcaClienteJuridico extends Model
{
    use HasFactory;

    protected $table = 'frm_conozca_cliente_juridico';
    public $timestamps = false;
    protected $dates = ['fecha_de_creacion', 'fecha_de_modificacion'];
    protected $fillable = [
        'nombre_comercial_juridico',
        'nacionalidad_juridico',
        'numero_de_nit_juridico',
        'fecha_de_constitucion_juridico',
        'registro_nrc_juridico',
        'telefono_juridico',
        'sitio_web_juridico',
        'numero_de_fax_juridico',
        'direccion_juridico',
        'monto_proyectado',
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

    public function conozcaCliente()
    {
        return $this->belongsTo(FrmConozcaCliente::class, 'frm_conozca_cliente_id');
    }
}
