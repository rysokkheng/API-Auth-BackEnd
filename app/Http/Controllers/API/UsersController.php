<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;
use Hash;

class UsersController extends Controller
{
   public function index()
    {
        $users = User::all();
        $data = UserResource::collection($users);
        return $this->getSuccessResponseArray(__('success'),$data);
     }
     public  function store(CreateUserRequest $request){

             DB::beginTransaction();
         try {
             $input = $request->all();
             $input['password'] = Hash::make($input['password']);
             $user = User::create($input);
             $user->assignRole($request->input('roles'));
             DB::commit();
             return $this->getSuccessResponseArray(__('global.save_success'),$user);
         }catch (\Exception $e){
             DB::rollBack();
             return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
         }

     }



}
