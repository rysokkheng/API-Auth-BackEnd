<?php

namespace App\Http\Middleware;

use App\Traits\CustomPassportTrait;
use App\Traits\StandardResponser;
use Closure;
use Illuminate\Http\Response;
use Lcobucci\JWT\Parser;
use League\OAuth2\Server\Exception\OAuthServerException;

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
        try {
            $token = $request->bearerToken();
            $parseToken = (new Parser())->parse((string)$token);

            // check token valid with the public key
            $validateKeyChain = $this->validateKeyChain($parseToken);

            // check token expired
            $validateExpiryDate = $this->validateExpiryDate($parseToken);
            // check the token has been revoked

            if (!($validateExpiryDate && $validateKeyChain)) {
                throw new \Exception('Unauthorized', Response::HTTP_UNAUTHORIZED);
            }

            return $next($request);

        }catch (\Exception $e)
        {
            throw new OAuthServerException('Unauthorized', Response::HTTP_UNAUTHORIZED, 'Invalid Header Authorization');
        }
    }


}
