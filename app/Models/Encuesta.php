<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_ENCUESTAS'; // Nombre de la conexión para esta base de datos
    protected $table = 'Encuesta';
    public $timestamps = false;

    protected $fillable = [
        'CodEvaluador',
        'Tipo',
        'Numero',
        'CodEvaluar',
        'IdCompetencia',
        'IdComportamiento',
        'IdEscala',
        'Relacion',
        'FechaReg',
        'UsuarioReg'
    ];
}
