<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserMessage;

class UserMessageService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $status = isset($params['status']) ?$params['status']: '';
        $info = UserMessage::with(['messageInfo'])->where(['user_id'=>$user_id])
            ->when($status!='', function ($query) use($status) {
                return $query->where('status',$status);
            })
            ->orderBy('status','desc')

             ->paginate($size);

//        $info = new OrderCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $info = UserMessage::create($data);

        return $info;
    }

    /**
     * 删除分享
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=UserMessage::find($id);
        
        return UserMessage::where(['id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = UserMessage::with(['messageInfo'])->where(['id'=>$id])->first();   
        return $article;
    }
    //一键阅读功能
    public function read_all($data){

        return UserMessage::where(['user_id'=>$data['user_id']])->update(['status'=>'1']); 
    }

}
