<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserKeyword;
use DB;

class UserKeywordService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $info = UserKeyword::where(['user_id'=>$user_id])
            ->orderBy('id','desc')
             ->get();
        //历史记录
            

        $historyinfo=UserKeyword::select('keyword', DB::raw('count(*) as num'))->groupBy('keyword')->orderby('num','desc')->limit(10)->get();
        $return['info']=$info;
        $return['historyinfo']=$historyinfo;

//        $info = new OrderCollection($info);

        return $return;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }
        //获取历史记录
        $res=UserKeyword::where(['user_id'=>$data['user_id'],'keyword'=>$data['keyword']])->first();
        if (empty($res)) {
            $info = UserKeyword::create($data);
        }else{
            $info=true;
        }

        return $info;
    }

    /**
     * 删除业务
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        
        return UserKeyword::where(['user_id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = UserKeyword::where(['id'=>$id])->first();   
        return $article;
    }

}
