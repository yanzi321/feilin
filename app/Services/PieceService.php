<?php

namespace App\Services;

use App\Piece;
use App\Exceptions\ErrorException;
use App\Http\Resources\PieceCollection;

class PieceService extends BaseService
{
    /**
     * 获取管理员列表
     * @return PieceCollection
     */
    public function collection($params = null)
    {
        $name = $params['name'] ?? '';

        $pieces = new PieceCollection(
            Piece::orderBy('piece_model_id')
                ->orderByDesc('sort')
                ->when($name, function ($query, $name) {
                    return $query->where('name', 'like', "%$name%");
                })
                ->with('pieceModel:id,name')
                ->paginate()
        );

        return $pieces;
    }

    /**
     * @param $id
     * @return PieceCollection
     */
    public function resource($id)
    {
        $tag = Piece::find($id);

        return new PieceCollection($tag);
    }

    /**
     * @param array $data
     * @return Piece|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        if (isset($data['piece_model'])) {
            unset($data['piece_model']);
        }

        $model = $data['model'];
        unset($data['model']);
        $data['values'] = \json_encode_unicode($model);

        return Piece::create($data);
    }

    /**
     * @param Piece $piece
     * @param $data
     * @return bool
     * @throws ErrorException
     */
    public function update(Piece $piece, $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        // 如果是更改状态，则直接更改即可
        if ($this->isSwitchStatus($data)) {
            return $piece->update($data);
        }

        if (isset($data['piece_model'])) {
            unset($data['piece_model']);
        }

        $model = $data['model'];
        unset($data['model']);
        $data['values'] = \json_encode_unicode($model);

        return $piece->update($data);
    }
}
