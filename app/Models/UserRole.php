<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends SpatieRole
{
    use SoftDeletes;

    protected $table = 'roles';
    protected $dates = ['deleted_at'];
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    public static function getSearchableColumns()
    {
        return ['name', 'nombre_tabla'];
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
}
