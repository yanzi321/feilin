<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Piece extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $pieceModel = $this->pieceModel;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'sort' => (int)$this->sort,
            'status' => (int)$this->status,
            'piece_model_id' => $this->piece_model_id,
            'piece_model' => $pieceModel,
            'model' => \json_decode($this->values)
        ];
    }
}
