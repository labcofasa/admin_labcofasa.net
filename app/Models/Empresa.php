<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'empresas';
    public $incrementing = true;
    protected $dates = ['deleted_at', 'fundacion'];
    protected $fillable = [
        'nombre',
        'direccion',
        'imagen',
        'telefono',
        'email',
        'web',
        'fundacion',
        'registro_nit',
        'registro_iva',
        'nombre_dnm',
        'registro_dnm',
        'nombre_tabla',
        'mision',
        'vision',
        'calidad',
    ];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getSearchableColumns()
    {
        return ['nombre', 'nombre_tabla'];
    }

    public function giro()
    {
        return $this->belongsTo(Giro::class);
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userModified()
    {
        return $this->belongsTo(User::class, 'user_modified_id');
    }
    public function userDeleted()
    {
        return $this->belongsTo(User::class, 'user_deleted_id');
    }
    public function restoreRecord()
    {
        if ($this->trashed()) {
            $this->restore();

            $this->user_deleted_id = null;
            $this->restored_at = now();
            $this->user_restored_id = auth()->id();
            $this->save();
        }
    }

    public function redesSociales()
    {
        return $this->hasMany(RedSocial::class, 'empresa_id');
    }
}
