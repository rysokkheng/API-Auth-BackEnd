<?php


namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class ResetPasswordTransformer extends TransformerAbstract
{
    public function transform(User $model)
    {
        return [
            'id'         => $model->id,
            'fullname'   => $model->fullname,
            'username'   => $model->username,
            'email'      => $model->email,
            'phone'      => $model->phone,
            'status'     => $model->record_status_id,
            'created_by' => $model->created_by,
            'created_at' => $model->created_at->format('d-M-Y'),
            'updated_at' => $model->updated_at->format('d-M-Y'),
        ];
    }
}
