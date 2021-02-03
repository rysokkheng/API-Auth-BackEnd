<?php

/**
 * Created by PhpStorm.
 * User: Ry Sokkheng
 * Date: 18/01/2021
 * Time: 10:50 PM
 */
namespace App\Services;


use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserResetRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends SimpleService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getUserByUsername($username){
        $user = $this->repository()->findWhere([
            'username' => $username,
            'record_status_id' => '1'
        ])->first();
        return $user;
    }
    public function getAll(){

        $result = $this->repository()->all();
        return $this->getSuccessResponseArray(__('success'), $result);
    }
    public function getUserProfile($AuthID){
        $result = User::with('userProfile')->find($AuthID);
        return $this->getSuccessResponseArray(__('success'), $result);
    }
    public function insert(UserCreateRequest $userCreateRequest)
    {
        DB::beginTransaction();
        try {
            $userCreateRequest->merge([
                'password'  => Hash::make($userCreateRequest->get('password')),
            ]);
            $user = $this->repository()->create($userCreateRequest->toArray());
            $user->assignRole($userCreateRequest->input('roles'));
            DB::commit();
            return $this->getSuccessResponseArray(__('Save Success'),$user);
        }catch (\Exception $e){
            DB::rollBack();
            return  $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR,$e->getMessage());
        }
        // TODO: Implement insert() method.
    }
    public function delete($id)
    {
        return $this->deleteData($id);
    }

    public function repository()
    {
        return $this->userRepository;
        // TODO: Implement repository() method.
    }
    public function resetPass (UserResetRequest $resetRequest, $id){
        DB::beginTransaction();
        try {
                $AuthId = Auth::id();
                if (!empty($resetRequest->get('password'))){
                    $resetRequest->merge( array(
                        'password' => Hash::make($resetRequest->get('password')),
                        'updated_by' =>  $AuthId
                    ));
                } else{
                    $resetRequest = collect($resetRequest->except('password'));
                }
                $getResetPass = $this->repository()->update($resetRequest->all(), $id);
            DB::commit();
                return $this->getSuccessResponseArray(__('Save Success'),$getResetPass);
        }catch (\Exception $e){
            DB::rollBack();
            return  $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR,$e->getMessage());
        }
    }
}
