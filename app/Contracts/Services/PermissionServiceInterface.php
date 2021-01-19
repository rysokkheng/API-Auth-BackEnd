<?php


namespace App\Contracts\Services;


use App\Http\Requests\Permission\PermissionsCreateRequest;

interface PermissionServiceInterface
{
    public function getAll();
    public function getByPaginate();
    public function insert(PermissionsCreateRequest $permissionsCreateRequest);
}
