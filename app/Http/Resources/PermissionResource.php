<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name_en' => $this->display_name_en,
            'created_at' => $this->created_at->format('d-M-Y'),
            'updated_at' => $this->updated_at->format('d-M-Y'),
        ];
    }
}
