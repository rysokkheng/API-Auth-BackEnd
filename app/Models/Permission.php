<?php

namespace App\Models;



class Permission extends \Spatie\Permission\Models\Permission
{
    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;
    const RECORD_STATUS_DELETE  = 0;

    const CREATED_AT_FIELD  = 'created_at';
    const CREATED_BY_FIELD  = 'created_by';
    const UPDATED_AT_FIELD  = 'updated_at';
    const UPDATED_BY_FIELD  = 'updated_by';


    protected $table = 'permissions';
    public $fillable = ['group_permission_id','name', 'display_name_en','display_name_kh', 'guard_name',self::RECORD_STATUS_FIELD, self::CREATED_BY_FIELD, self::UPDATED_BY_FIELD];


    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'group_permission_id', 'id');
    }
    public static function getTableNameByConnection(){
        $__table = (new static())->table;
        $__database = (new static())->getConnection()->getName();
        return $__database.'.'.$__table;
    }
}
