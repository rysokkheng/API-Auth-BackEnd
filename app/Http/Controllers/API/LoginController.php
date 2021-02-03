<?php


namespace App\Http\Controllers\API;


use App\Contracts\Services\LoginServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Login\CreateLoginRequest;

class LoginController extends Controller
{
    private $loginService;
    public function __construct(LoginServiceInterface $loginService) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->loginService = $loginService;
    }
    public function login(CreateLoginRequest $createLoginRequest){
         $result = $this->loginService->login($createLoginRequest);
         return response()->json($result, $result['http_code']);
    }
    public function refreshToken(CreateLoginRequest $createLoginRequest){
        $result = $this->loginService->refreshToken($createLoginRequest);
        return response()->json($result, $result['http_code']);
    }

}
