<?php

namespace App\Http\Middleware;

use App\Models\OauthAccessTokens;
use App\Traits\CustomPassportTrait;
use App\Traits\StandardResponser;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VerifyToken
{
    use StandardResponser, CustomPassportTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $userSerialize = serialize($user);
        $userUniversalizeArray = (array) unserialize($userSerialize);
        $arrayKeys = array_keys($userUniversalizeArray);
        foreach ($arrayKeys as $value)
        {
            if (strpos($value, 'accessToken') !== false) {
                $userAccessTokenArray = (array) $userUniversalizeArray[$value];
                $arrayAccessKeys = array_keys($userAccessTokenArray);
                foreach ($arrayAccessKeys as $arrayAccessValue) {
                    if (strpos($arrayAccessValue, 'original') !== false) {
                        $userId = Auth::user()->id;
                      $userTokenId = DB::table('oauth_access_tokens')
                          ->select('id')
                          ->where('user_id',$userId)
                          ->orderBy('created_at', 'DESC')->limit(1)->value('id');
                        $checkToken = OauthAccessTokens::where([
                            ['id', '=', $userTokenId],
                            ['expires_at', '>', Carbon::now()]
                        ])->first();
                        if ( !$checkToken ) {
                            return response()->json([
                                'http_code'=>Response::HTTP_UNAUTHORIZED,
                                'message'=> 'Token time has expired. Please log in again.'
                            ]);
                        }
                    }
                }
            }
        }
        return $next($request);
    }


}
