<?php

/**
 * Created by PhpStorm.
 * User: Ry Sokkheng
 * Date: 18/01/2021
 * Time: 10:22 PM
 */


namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RecordStatusCriteria
 * @package App\Criteria
 */
class RecordStatusCriteria implements CriteriaInterface
{
    public function __construct()
    {
    }

    /**
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model,RepositoryInterface $repository){
        $classModel = $model;
        $model = $model->where(function ($query) use ($classModel){
            return $query->where($classModel::RECORD_STATUS_FIELD, $classModel::RECORD_STATUS_ACTIVE);
        });
        return $model;


    }



}
