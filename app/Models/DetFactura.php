<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetFactura extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_GIFT';
    protected $table = 'factura_detalles';
    protected $primaryKey = 'idDetalle';
    public $timestamps = false;

    protected $fillable = [
        'idDetalle',
        'idFactura',
        'idGiftCard',
        'cantidad',
        'precio_unitario',
        'descripcion',
        'subtotal',
        'eliminado',
        'FechaReg',
        'UsuarioReg',
        'FechaMod',
        'UsuarioMod',
        'FechaEli',
        'UsuarioEli'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'idFactura', 'idFactura');
    }

    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class, 'idGiftCard', 'idGift');
    }

}
