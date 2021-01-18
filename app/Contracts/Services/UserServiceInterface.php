<?php


namespace App\Contracts\Services;


use App\Http\Requests\User\CreateUserRequest;

interface UserServiceInterface
{
    public function getAll();
    public function getByPaginate();
    public function getById($id);
    public function insert(CreateUserRequest $userCreateRequest);
    public function delete($id);
}
