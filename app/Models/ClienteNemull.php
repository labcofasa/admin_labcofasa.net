<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteNemull extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_NEMULL';

    protected $table = 'clientes';
}
