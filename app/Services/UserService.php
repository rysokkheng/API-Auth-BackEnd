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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends SimpleService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAll(){

        $result = $this->repository()->all();
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
}
