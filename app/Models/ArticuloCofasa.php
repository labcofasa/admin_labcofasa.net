<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticuloCofasa extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_COFASA';

    protected $table = 'articulos';
}
