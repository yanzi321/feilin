<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProtocolCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'code' => 200,
            'msg' => 'success',
            'data' => $this->collection,
        ];
    }
}
