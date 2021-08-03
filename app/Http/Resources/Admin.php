<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Role as RoleResource;

class Admin extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tel' => $this->tel,
            'job_number' => $this->job_number,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'roles' => RoleResource::collection($this->roles),
            'status' => $this->status,
        ];
    }
}
