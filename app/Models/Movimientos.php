<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimientos extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_GIFT';
    protected $table = 'Movimiento';
    protected $primaryKey = 'idMovimiento';
    public $timestamps = false;

    protected $fillable = [
        'idFactura',
        'idGift',
        'idTipoMovimiento',
        'idVendedor',
        'idCliente',
        'idArticulo',
        'cantidad',
        'valorMovimiento',
        'fechaMovimiento',
        'eliminado',
        'usuarioReg',
        'fechaReg',
        'usuarioMod',
        'fechaMod',
        'usuarioEli',
        'fechaEli',
        'idAgrupacion',
    ];
}
