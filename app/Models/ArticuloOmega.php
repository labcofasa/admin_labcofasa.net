<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloOmega extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_OMEGA';

    protected $table = 'articulos';
}

