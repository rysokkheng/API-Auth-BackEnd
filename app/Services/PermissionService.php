<?php


namespace App\Services;


use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Services\PermissionServiceInterface;
use App\Http\Requests\Permission\PermissionsCreateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
    public function insert(PermissionsCreateRequest $permissionsCreateRequest)
    {
            DB::beginTransaction();
        try {
                $permission = $this->repository()->create($permissionsCreateRequest->toArray());
            DB::commit();
                return $this->getSuccessResponseArray(__('Save Success'),$permission);
        }catch (\Exception $e){
            DB::rollBack();
                return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR , $e->getMessage());
        }
    }

    public function repository()
    {
        return $this->permissionRepository;
    }
}
