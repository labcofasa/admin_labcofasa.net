<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloNemull extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_NEMULL';

    protected $table = 'articulos';
}
