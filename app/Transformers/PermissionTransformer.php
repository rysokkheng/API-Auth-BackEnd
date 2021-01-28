<?php

namespace App\Transformers;

use App\Models\Permission;
use League\Fractal\TransformerAbstract;

class PermissionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'display_name_en' => $model->display_name_en,
            'display_name_kh' => $model->display_name_kh,
            'status' => $model->record_status_id,
            'created_at' => $model->created_at->format('d-M-Y'),
            'updated_at' => $model->updated_at->format('d-M-Y'),
        ];
    }
}
