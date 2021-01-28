<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $table = 'permission_groups';

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'group_permission_id', 'id');
    }

}
