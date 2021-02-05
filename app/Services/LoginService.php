<?php


namespace App\Services;


use App\Contracts\Repositories\LoginRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\LoginServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Enums\DateFormatEnum;
use App\Enums\PermissionEnum;
use App\Helpers\PBKDF2;
use App\Http\Requests\Login\CreateLoginRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class LoginService extends SimpleService implements LoginServiceInterface
{
    private $loginRepository;
    private $userService;
    private $userRepository;

    public function __construct(LoginRepositoryInterface $loginRepository,UserServiceInterface $userService,UserRepositoryInterface $userRepository) {
        $this->loginRepository = $loginRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }
    public function login(CreateLoginRequest $createLoginRequest)
    {
        $username = $createLoginRequest->username;
        $password = $createLoginRequest->password;
        $user = $this->userService->getUserByUsername($username);
        if ($user && $user->id){
            if (Str::contains($user->password,'==:') && Str::endsWith($user->password,'==')){
                if (PBKDF2::validatePassword($password,$user->password)){
                    if (Auth::guard('web')->loginUsingId($user->id)){
                        $token = $this->getToken($user);
                        if ($token){
                            return $this->getSuccessResponseArray(__('success'), $token);
                        }
                    }
                }
            }else{
                if (Auth::guard('web')->attempt(['username' => $username, 'password' => $password])){
                    $token = $this->getToken($user);
                    if ($token){
                        return $this->getSuccessResponseArray(__('success'), $token);
                    }
                }
            }
        }
        return $this->getErrorResponseArray(Response::HTTP_UNAUTHORIZED,__('Login fail'));
    }

    private function getToken($user){
        $tokenResult = $user->createToken('Personal Access Token');
        $userId = (Auth::guard('web')->id());
        $user = $this->userRepository->find($userId);
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        $role = $user->roles->pluck('name')->toArray();
        return $data = [
            'user' => $user,
            'role' => $role,
            'permission' => $permissions,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::parse($tokenResult->token->expires_at)->format(DateFormatEnum::YmdHis),
            'data' => $tokenResult->accessToken
        ];


    }
    public function refreshToken(CreateLoginRequest $createLoginRequest){
        dd("s");
    }


    public function repository()
    {
        return $this->loginRepository;
        // TODO: Implement repository() method.
    }
}
