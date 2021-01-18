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


    public function repository()
    {
        return $this->userRepository;
        // TODO: Implement repository() method.
    }
}
