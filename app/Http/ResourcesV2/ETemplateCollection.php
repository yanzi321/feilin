<?php

namespace App\Http\ResourcesV2;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ETemplateCollection extends ResourceCollection
{
    /**
    * Transform the resource collection into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
