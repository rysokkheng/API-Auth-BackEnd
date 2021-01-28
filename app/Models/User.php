<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens, Notifiable;
    use HasRoles;
    protected $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;
    const RECORD_STATUS_DELETE  = 0;


    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'phone',
        self::RECORD_STATUS_FIELD,
        'created_by',
        'updated_by',
    ];
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function userProfile() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


}
