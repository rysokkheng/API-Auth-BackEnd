<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

   public function store(Request $request){
       $validator = Validator::make($request->all(), [
           'name' => 'required'
       ]);
       if($validator->fails()){
           return response()->json(['error' => $validator->errors()], 401);
       }
       $input = $request->all();
       $permission = Permission::create(['name' => $input['name']]);
       if($permission){
           return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $permission,'message' => 'Create successfully']);
       }
   }
}
