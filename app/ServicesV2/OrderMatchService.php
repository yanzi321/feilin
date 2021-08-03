<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\MatchCollection;
use App\Models\Basic\Business;
use App\Models\Basic\Match;
use DB;

class OrderMatchService
{

   public function collection($params = null)
    {
        $is_match = $params['is_match'] ?? 1;
        $size = $params['pageSize'] ?? 10;
        if ($is_match=='1') {
            $info = Match::with(['matcha','matchb'])->orderBy('id','desc')
                ->paginate($size);
        }else{
            $info=Business::where(['is_match'=>'0'])->orderBy('id','desc')
             ->paginate($size);
        }
        // $info = new OrderCollection($info);

        return $info;
    }

    public function collectionpc($params = null)
    {
        //判断企业有没有撮合
        $dataa = Match::with(['matchb'])->where('party_a', $params['id'])
            ->get()->toArray();
        $datab = Match::with(['matcha'])->where('party_b', $params['id'])
            ->get()->toArray();

        //合并
        // $info = new OrderCollection($info);
        $info=array_merge($dataa,$datab);
        // dump($info);die;
        if (!empty($info)) {
            foreach ($info as $key => &$value) {
                // dump($value['matchb']);die;
                if (!empty($value['matchb'])) {
                    $info[$key]['match']=$value['matchb'];
                    unset($info[$key]['matchb']);
                }elseif(!empty($value['matcha'])){
                    $info[$key]['match']=$value['matcha'];
                    unset($info[$key]['matcha']);
                }
            }
        }
        return $info;
    }

    public function show($id){
        $info = Match::with(['matcha','matchb'])->where(['id'=>$id])->first();

        return $info;

    }
    public function delete($id){

        $match=Match::where(['id'=>$id])->first();
        DB::beginTransaction();
        try {
            //删除表信息
            // 把bussiness状态改掉
            
            
            $savea['is_match']='0';
            $savea['match_id']='0';
            $saveb['is_match']='0';
            $saveb['match_id']='0';
            $business=Business::where(['id'=>$match['party_a']])->first();
            $businessb=Business::where(['id'=>$match['party_b']])->first();
            $resa=$business->update($savea);
            $resb=$businessb->update($saveb);
            Match::where(['id'=>$id])->delete();
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }

}
