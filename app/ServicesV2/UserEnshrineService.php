<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserEnshrine;

class UserEnshrineService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $status = isset($params['status']) ?$params['status']: '';
        $info = UserEnshrine::with(['articleInfo'])->where(['user_id'=>$user_id])
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

        $info = UserEnshrine::create($data);

        return $info;
    }

    /**
     * 删除分享
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=UserEnshrine::find($id);
        
        return UserEnshrine::where(['id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = UserEnshrine::where(['id'=>$id])->first();   
        return $article;
    }

}
