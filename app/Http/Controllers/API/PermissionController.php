<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Permission\PermissionsRequest;
use App\Http\Resources\PermissionResource;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index(){
        $getPermission = Permission::where('record_status_id',1)->limit(10)->get();
        $data = PermissionResource::collection($getPermission);
        if (!empty($data)){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $data,'errors' => 'errors']);
        }
    }
    public function show($id){
       $getPer = Permission::where('id',$id)->get();
       $data = PermissionResource::collection($getPer);
        if (!empty($data)){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $data,'errors' => 'errors']);
        }
    }
   public function store(PermissionsRequest $request){

       $input = $request->all();
       $permission = Permission::create($input);
       $data = PermissionResource::collection($permission);
       if($data){
           return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'Create successfully']);
       }
   }
   public function destroy($id){
        $user = Auth::user()->id;
        $delPermission = Permission::where('id',$id)->update('record_status_id','1')->get();
        $data = PermissionResource::collection($delPermission);
       if (!empty($data)){
           return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'Delete Permission Successfully']);
       }else{
           return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $data,'errors' => 'errors']);
       }
   }
   public function all(){

   }
}
