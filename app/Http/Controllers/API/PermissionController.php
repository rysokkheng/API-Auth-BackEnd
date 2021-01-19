<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\PermissionServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionsCreateRequest;
use App\Transformers\PermissionTransformer;
use App\User;
use Spatie\Fractal\Fractal;
use Validator;


class PermissionController extends Controller
{
    private $permissionService;
    protected $transformer = PermissionTransformer::class;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index(){
        $result = $this->permissionService->getByPaginate();
        $result['data'] = Fractal::create( $result['data'] , new PermissionTransformer())->toArray();
        return response()->json($result, $result['http_code']);
    }
    public function getAll(){
        $result = $this->permissionService->getAll();
        $result['data'] = Fractal::create( $result['data'] , new PermissionTransformer())->toArray();
        return response()->json($result, $result['http_code']);
    }
    public function store(PermissionsCreateRequest $permissionsCreateRequest){
        $result = $this->permissionService->insert($permissionsCreateRequest);
        return response()->json($result, $result['http_code']);
    }




}
