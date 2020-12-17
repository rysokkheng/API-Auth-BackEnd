<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;

class RolesController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $role,'message' => 'Create Success']);

    }

}
