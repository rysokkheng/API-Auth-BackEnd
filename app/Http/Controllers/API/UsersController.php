<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Hash;

class UsersController extends Controller
{


   public function index()
    {
        $users = User::all();
        $data = UserResource::collection($users);
        if (!empty($data)){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $data,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $data,'errors' => 'errors']);
        }

     }
     public  function store(CreateUserRequest $request){

          $input = $request->all();
          $input['password'] = Hash::make($input['password']);
          $user = User::create($input);
          $user->assignRole($request->input('roles'));


         return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $user,'message' => 'Create User Successfully']);
     }



}
