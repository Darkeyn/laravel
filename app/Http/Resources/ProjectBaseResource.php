<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectBaseResource extends JsonResource
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
            'adress' => $this->adress,
            'ssh' => $this->ssh,
            'admin_login' => $this->admin_login,
            'admin_password' => $this->admin_password,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'pivot' => $this->pivot,
        ];
    }
}
