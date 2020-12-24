<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{

    protected $table = 'oauth_clients';
    protected $fillable = ['id', 'user_id', 'name'
        , 'secret','provider', 'redirect', 'personal_access_client'
        , 'password_client', 'revoked'
        , 'created_at', 'updated_at'];
}
