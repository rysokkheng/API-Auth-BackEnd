<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\PermissionServiceInterface;
use App\Http\Requests\Permission\PermissionsRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Controllers\Controller;
use App\Transformers\PermissionTransformer;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractal\Fractal;
use Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    private $permissionService;
    protected $transformer = PermissionTransformer::class;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function getAll(){
        $result = $this->permissionService->getAll();
        $result['data'] = Fractal::create( $result['data'] , new PermissionTransformer())->toArray();
        return response()->json($result, $result['http_code']);
    }



}
