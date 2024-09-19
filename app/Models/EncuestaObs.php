<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaObs extends Model
{
    use HasFactory;
    protected $connection = 'DB_CONNECTION_ENCUESTAS';
    protected $table = 'EncuestaObs';

    public $timestamps = false;

    protected $fillable = [
        'CodEvaluador',
        'CodEvaluar',
        'Observacion',
        'NombreCurso',
        'usuarioReg',
        'FechaReg',
    ] ;
}
