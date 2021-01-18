<?php


namespace App\Repositories;


use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Models\Permission;
use Prettus\Repository\Criteria\RequestCriteria;

class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepositoryInterface
{

    public function model()
    {
        // TODO: Implement model() method.
        return Permission::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
