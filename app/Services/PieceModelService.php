<?php

namespace App\Services;

use App\PieceModel;
use App\Exceptions\ErrorException;
use App\Http\Resources\PieceModelCollection;

class PieceModelService
{
    /**
     * 获取管理员列表
     * @return PieceModelCollection
     */
    public function collection($params = null)
    {
        $categories = new PieceModelCollection(PieceModel::orderByDesc('updated_at')->get());

        return $categories;
    }

    /**
     * @param $id
     * @return PieceModelCollection
     */
    public function resource($id)
    {
        $tag = PieceModel::find($id);

        return new PieceModelCollection($tag);
    }

    /**
     * @param array $data
     * @return PieceModel|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $data['fields'] = \json_encode_unicode($data['fields']);

        return PieceModel::create($data);
    }

    /**
     * @param PieceModel $pieceModel
     * @param $data
     * @return bool
     * @throws ErrorException
     */
    public function update(PieceModel $pieceModel, $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $data['fields'] = \json_encode_unicode($data['fields']);

        return $pieceModel->update($data);
    }
}
