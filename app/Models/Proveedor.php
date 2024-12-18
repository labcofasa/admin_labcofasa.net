<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_GIFT'; 
    protected $table = 'vProveedoresCO'; 
    public $timestamps = false; // No necesitas timestamps si no los estás usando
    
    // Define solo las columnas que estás mostrando
    protected $fillable = [
        'RegIva',
        'Nombre',
        'Direccion',
        'Nit',
    ];
}
