<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class RolesController extends Controller
{

    public function store(Request $request){
        $auth_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'displayname' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name'),
                            'displayname' => $request->input('displayname'),
                            'created_by' => $auth_id

        ]);

        $role->syncPermissions($request->input('permission'));
        return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $role,'message' => 'Create Success']);

    }

}
