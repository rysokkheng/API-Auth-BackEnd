<?php

/**
 * Created by PhpStorm.
 * User: Ry Sokkheng
 * Date: 18/01/2021
 * Time: 10:22 PM
 */

namespace App\Services;


 use App\Criteria\RecordStatusCriteria;
 use Mockery\Exception;

 /**
  * Class SimpleService
  * @package App\Services
  */
 abstract class SimpleService extends BaseService
{
    public $hasRecordStatus = true;

    public abstract function repository();

    public function __construct()
    {

        if ($this->repository()== null){
            throw new Exception(get_class($this).' extends from BaseService must implement repository method with returning a repository.');
        }
    }

     /**
      * @return array
      */
    public function getByPaginate(){
        if ($this->hasRecordStatus){
            $recordStatusCriteria = new RecordStatusCriteria();
            $result = $this->repository()
                           ->pushCriteria($recordStatusCriteria)
                           ->paginate();
        }else{
            $result = $this->repository()->paginate();
        }
        return $this->getSuccessResponseArray(__('success'),$result);
    }


    public function getAll(){

        if ($this->hasRecordStatus){
            $result = $this->repository()->all();
        }else{
            $result = $this->repository()->all();
        }
        return $this->getSuccessResponseArray(__('success'),$result);
    }

 }
