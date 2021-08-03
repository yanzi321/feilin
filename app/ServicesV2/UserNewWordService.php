<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\UserNewWord;

class UserNewWordService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $info = UserNewWord::where(['user_id'=>$user_id])
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

        $info = UserNewWord::create($data);

        return $info;
    }

    /**
     * 删除业务
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=UserNewWord::find($id);
        
        return UserNewWord::where(['id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = UserNewWord::where(['id'=>$id])->first();   
        return $article;
    }

}
