<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Giro extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'giros';
    protected $dates = ['deleted_at'];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getSearchableColumns()
    {
        return ['nombre', 'nombre_tabla'];
    }

    protected $fillable = ['nombre', 'codigo_mh'];

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
}
