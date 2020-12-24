<?php
namespace App\Http\Controllers\API;

use App\Models\OauthAccessTokens;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only(['username', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'success' => true,
                'http_code' => Response::HTTP_OK,
                'token' => $data,
                'token_type' => 'Bearer',
                'expires_in' => 'Bearer',
                'message' => 'login_success'
            ]);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function register(Request $request)
    {

        $request->validate([
            'fullname' => 'required',
            'username' => 'required|username',
            'email' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phone' => 'required',


        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);

        $success['name'] = $user->name;
        $success['token'] = $user->createToken('MyApp')->accessToken;
        return response()->json(['success' => $success], 200);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $success['name'] = $user->name;
        $success['token'] = $user->createToken('MyApp', ['*'])->accessToken;
        return response()->json(['success' => $success], 200);
    }
    public function userProfile() {
        return response()->json(auth()->user());
    }



}
