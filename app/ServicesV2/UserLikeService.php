<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserLike;

class UserLikeService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $status = isset($params['status']) ?$params['status']: '';
        $info = UserLike::with(['articleInfo'])->where(['user_id'=>$user_id])
            ->when($status!='', function ($query) use($status) {
                return $query->where('status',$status);
            })
            ->orderBy('id','desc')

             ->paginate($size);

//        $info = new OrderCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $info = UserLike::create($data);

        return $info;
    }

    /**
     * 删除分享
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=UserLike::find($id);
        
        return UserLike::where(['id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = UserLike::where(['id'=>$id])->first();   
        return $article;
    }

}
