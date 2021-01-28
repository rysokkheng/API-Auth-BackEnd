<?php


namespace App\Contracts\Services;


use App\Http\Requests\User\UserCreateRequest;

interface UserServiceInterface
{
    public function getAll();
    public function getByPaginate();
    public function getById($id);
    public function getUserProfile($AuthID);
    public function insert(UserCreateRequest $userCreateRequest);
    public function delete($id);
}
