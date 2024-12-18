<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_GIFT';
    protected $table = 'GiftCards';
    protected $primaryKey = 'idGift';
    public $timestamps = false;

    protected $fillable = [
        'valor', 
        'cantidad', 
        'saldo', 
        'eliminado',
        'usuarioReg',
        'fechaReg',
        'usuarioMod',
        'fechaMod',
        'usuarioEli',
        'fechaEli'
    ];
    protected $attributes = [
        'cantidad' => 0,  // Cantidad inicial en 0
        'eliminado' => 0,  // No eliminado por defecto
    ];

    public function getSaldoAttribute()
    {
        return $this->valor * $this->cantidad;
    }

    // Opcional: Si deseas tener un campo que represente si está activo o no
    public function isActive()
    {
        return !$this->eliminado;
    }
}
