<?php


namespace App\Repositories;


use App\Contracts\Repositories\LoginRepositoryInterface;

use App\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;

class LoginRepositoryEloquent extends BaseRepository implements LoginRepositoryInterface
{
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
