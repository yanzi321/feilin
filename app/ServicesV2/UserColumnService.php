<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserColumn;

class UserColumnService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;

        $info = UserColumn::with(['categoriesInfo'])
            ->where(['user_id'=>$user_id])
            ->orderBy('id','desc')
            ->get();

//        $info = new OrderCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $info = UserColumn::create($data);

        return $info;
    }

    /**
     * 删除业务
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=UserColumn::find($id);
        
        return UserColumn::where(['id'=>$id])->delete();

    }

}
