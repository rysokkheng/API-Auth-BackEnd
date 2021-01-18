<?php
/**
 * Created by PhpStorm.
 * User: Ry Sokkheng
 * Date: 18/01/2021
 * Time: 10:22 PM
 */


namespace App\Services;


 use App\Traits\StandardResponser;
 use Illuminate\Foundation\Validation\ValidatesRequests;

 abstract class BaseService
{
    use ValidatesRequests,StandardResponser;
}
