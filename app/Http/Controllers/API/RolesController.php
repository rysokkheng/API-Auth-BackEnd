<?php
namespace App\Http\Controllers\API;


use App\Transformers\RoleTransformers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        if ($roles){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $roles,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_INTERNAL_SERVER_ERROR,'data' => $roles,'errors' => 'errors']);
        }
    }
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
