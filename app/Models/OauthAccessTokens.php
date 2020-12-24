<?php


namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class OauthAccessTokens extends Model
{

    protected $table = 'oauth_access_tokens';
    protected $fillable = ['id', 'user_id', 'client_id','name'
        , 'scopes','revoked', 'created_at', 'updated_at'
        , 'expires_at'];


}
