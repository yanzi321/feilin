<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserColumnCollection;
use App\Models\Basic\ReadNotes;

class ReadNoteService
{

    public function collection($params)
    {

        $user_id = $params['user_id'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $status = isset($params['status']) ?$params['status']: '';
        $info = ReadNotes::with(['articleInfo'])->where(['user_id'=>$user_id])
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

        $info = ReadNotes::create($data);

        return $info;
    }

    /**
     * 删除业务
     *
     * @param      <type>  $id     The identifier
     */
    public function delete($id){
        $order=ReadNotes::find($id);
        
        return ReadNotes::where(['id'=>$id])->delete();

    }
    //详情
    public function show($id){
        $article = ReadNotes::where(['id'=>$id])->first();   
        return $article;
    }

}
