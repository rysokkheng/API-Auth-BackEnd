<?php


namespace App\Services;


use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Services\PermissionServiceInterface;

class PermissionService extends SimpleService implements PermissionServiceInterface
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll(){
        $result = $this->repository()->all();
        return $this->getSuccessResponseArray(__('success'), $result);
    }

    public function repository()
    {
        return $this->permissionRepository;
    }
}
