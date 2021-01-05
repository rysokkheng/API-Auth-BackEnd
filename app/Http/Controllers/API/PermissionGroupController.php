<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionGroupResource;
use App\Models\PermissionGroup;
use Illuminate\Http\Response;

class PermissionGroupController extends Controller
{
    public function getAll(){

        $getPermissionGroup = PermissionGroup::where('record_status_id',1)->limit(10)->get();
        $data = PermissionGroupResource::collection($getPermissionGroup);
        if (!empty($data)){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $data,'errors' => 'errors']);
        }
    }
}
