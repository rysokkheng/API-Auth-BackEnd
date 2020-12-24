<?php


namespace App\Traits;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\ValidationData;

trait CustomPassportTrait
{
    public function   validateKeyChain($parseToken)
    {
        $path = 'file://'.storage_path().'/oauth-public.key';
        $signer = new Sha256();
        $publicKey = new Key($path);
        return $parseToken->verify($signer, $publicKey);;
    }

    private function validateExpiryDate($parseToken)
    {
        $data = new ValidationData();
        return $parseToken->validate($data);
    }

    public function getDecodeInfoFromAccessToken($accessToken)
    {
        $parseToken = (new Parser())->parse((string) $accessToken);

        if ($this->validateKeyChain($parseToken)) {
            $decodeToken['aud']     =  $parseToken->getClaim('aud');
            $decodeToken['sub']     =  $parseToken->getClaim('sub');
            $decodeToken['iat']     =  $parseToken->getClaim('iat');
            $decodeToken['nbf']     =  $parseToken->getClaim('nbf');
            $decodeToken['exp']     =  $parseToken->getClaim('exp');
            $decodeToken['scopes']  =  $parseToken->getClaim('scopes');
            $decodeToken['roles']   =  $parseToken->getClaim('roles');
            $decodeToken['permissions'] =  $parseToken->getClaim('permissions');
            return $decodeToken;
        }
        throw new \Exception('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

}
