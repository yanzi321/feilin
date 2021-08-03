<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

// CommissionRule
class CommissionRuleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => 200,
            'msg' => 'success',
            'data' => $this->collection,
        ];
    }
}
