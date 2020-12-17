<?php

namespace App\Models;

use App\Traits\HasTimestamps;
use Zizaco\Entrust\EntrustRole;


class Role extends  \Spatie\Permission\Models\Role
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'displayname',
        'record_status_id',
        'created_by',
        'updated_by',
    ];
}
