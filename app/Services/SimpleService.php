<?php

/**
 * Created by PhpStorm.
 * User: Ry Sokkheng
 * Date: 18/01/2021
 * Time: 10:22 PM
 */

namespace App\Services;


 use App\Criteria\RecordStatusCriteria;

 use App\Models\BaseModel;
 use Mockery\Exception;
 use  Illuminate\Http\Response;


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
            $result = $this->repository()->findWhere([BaseModel::RECORD_STATUS_FIELD=>BaseModel::RECORD_STATUS_ACTIVE])->all();
        }else{
            $result = $this->repository()->all();
        }
        return $this->getSuccessResponseArray(__('success'),$result);
    }

    public function insertData($request){
        try {
            $data = $this->repository()->create($request->all());
            return $this->getSuccessResponseArray(__('Save Success'),$data);
        }catch ( \Exception $e){
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR , $e->getMessage());
        }
    }
    public function getById($id){
        $result = $this->repository()->find($id);
        return $this->getSuccessResponseArray(__('success'),$result);
    }

    public function updateData($request,$id){
        try {
            $data = $this->repository()->update($request->all(),$id);
            return $this->getSuccessResponseArray(__('Update Success'),$data);
        }catch (\Exception $e){
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR,$e->getMessage());
        }
    }
    public function deleteData($id){
        try {
            $data = $this->repository()->update([BaseModel::RECORD_STATUS_FIELD=>BaseModel::RECORD_STATUS_DELETE],$id);
            return $this->getSuccessResponseArray(__('Delete Success'),$data);
        }catch ( \Exception $e){
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR , $e->getMessage());
        }
    }
    public function destroyData($id){
        try {
            $data = $this->repository()->delete($id);
            return $this->getSuccessResponseArray(__('Delete Success'),$data);
        }catch (\Exception $e){
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR,$e->getMessage());
        }
    }

 }
