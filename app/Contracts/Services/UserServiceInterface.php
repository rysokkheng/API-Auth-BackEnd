<?php


namespace App\Contracts\Services;


use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserResetRequest;

interface UserServiceInterface
{
    public function getAll();
    public function getUserByUsername($username);
    public function getByPaginate();
    public function resetPass(UserResetRequest $resetRequest, $id);
    public function getById($id);
    public function getUserProfile($AuthID);
    public function insert(UserCreateRequest $userCreateRequest);
    public function delete($id);
}
