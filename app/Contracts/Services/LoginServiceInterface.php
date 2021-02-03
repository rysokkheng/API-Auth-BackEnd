<?php


namespace App\Contracts\Services;


use App\Http\Requests\Login\CreateLoginRequest;

interface LoginServiceInterface
{
    public function login(CreateLoginRequest $createLoginRequest);
    public function refreshToken(CreateLoginRequest $createLoginRequest);
}
