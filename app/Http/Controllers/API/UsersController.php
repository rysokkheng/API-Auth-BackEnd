<?php
namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
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
        if (!empty($users)){
            return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $users,'message' => 'successfully']);
        }else{
            return response()->json(['success' => false, 'http_code' => Response::HTTP_NOT_FOUND,'data' => $users,'errors' => 'errors']);
        }

     }
     public  function store(Request $request){
         $validator = Validator::make($request->all(), [
             'fullname' => 'required',
             'username' => 'required',
             'email' => 'required|email',
             'password' => 'required',
             'c_password' => 'required|same:password',
             'phone'  => 'required|min:11|numeric',
             'roles' => 'required',
         ]);
         if ($validator->fails()) {
             return response()->json(['error'=>$validator->errors()])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY); // 422
         }
          $input = $request->all();
          $input['password'] = Hash::make($input['password']);
          $user = User::create($input);
          $user->assignRole($request->input('roles'));
         return response()->json(['success' => true, 'http_code' => Response::HTTP_OK,'data' => $user,'message' => 'Create User Successfully']);
     }



}
