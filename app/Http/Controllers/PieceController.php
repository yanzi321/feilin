<?php

namespace App\Http\Controllers;

use App\Piece;
use Illuminate\Http\Request;

class PieceController extends BaseController
{
    public function index(Request $request)
    {
        $name = $request->input('name', '');
        $module_name = $request->input('model_name', '');
        $ids = $request->input('ids', '');
        $idArr = explode(',', $ids);
        $idSearch = !(count($idArr) == 1 && empty($idArr[0]));

        if (empty($name) && empty($module_name) && empty($idSearch)) {
            return $this->error('请输入搜索条件');
        }

        $pieces = Piece::select('id', 'name', 'values')
            ->where('status', 1)
            ->orderBy('sort')
            ->when($name, function($query) use ($name){
                $query->where('name', $name);
            })->when($module_name, function ($query) use ($module_name) {
                $query->whereHas('pieceModel', function ($q) use ($module_name) {
                   $q->where('name', $module_name);
                });
            })->when($idSearch, function ($query) use ($idArr) {
                $query->whereIn('id', $idArr);
            })->get();

        $pieces = $pieces->map(function ($piece) {
            $piece->items = \json_decode($piece->values)->fields;
            unset($piece->values);
            return $piece;
        });

        return $this->success($pieces);
    }
}
