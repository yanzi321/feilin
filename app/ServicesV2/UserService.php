<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserCollection;
use App\Models\Basic\User;
use App\Models\Basic\UserRead;
use DB;

class UserService
{

    public function collection($params = null)
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'desc';
        $credit_code = $params['credit_code'] ?? '';
        $status = isset($params['status']) ?$params['status']: '';
        $created_at = $params['time'] ?? '';

        $info = User::orderBy('id',$sort)
            ->when($status!='', function ($query) use($status) {
                return $query->where('status',$status);
            })
            ->when($credit_code!='', function ($query) use($credit_code) {
                return $query->where('credit_code','like',$credit_code);
            })
            ->when($created_at!='', function ($query) use($created_at) {
                return $query->whereBetween('created_at',$created_at);
            })
            ->paginate($size);
        // $info = new UserCollection($info);

        return $info;
    }
    public function businessIndex($params = null){
        $info = User::orderBy('id','desc')
            ->get();
        // $info = new UserCollection($info);

        return $info;

    }
    public function collectionBus($params = null)
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'desc';
        $is_match = isset($params['is_match']) ?$params['is_match']: '0';
        if ($params['is_match']=='1') {
            $info = User::orderBy('id',$sort)
                ->when($is_match!='', function ($query) use($is_match) {
                    return $query->where('is_match',$is_match);
                })
                ->paginate($size);
        }else{
            $info = User::orderBy('id',$sort)
                ->when($is_match!='', function ($query) use($is_match) {
                    return $query->where('is_match',$is_match);
                })
                ->paginate($size);
        }
        // $info = new UserCollection($info);

        return $info;
    }
   

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return User::create($data);
    }
    /**
     * { function_description }
     *
     * @param      \App\Models\Basic\User  $business  The business
     * @param      <type>                      $data      The data
     *
     * @return     bool                        ( description_of_the_return_value )
     */
    public function updateUser(User $model, $data){
        if (isset($data['contants'])) {
            $contants=$data['contants'];
            unset($data['contants']);
        }
        $business=User::find($data['id']);
        DB::beginTransaction();
        try {
            // $contants[0]['name']='zhangsan';
            // $contants[0]['mobile']='151611343';
            if (isset($contants)) {
                $business_contact = new Contact();
                foreach ($contants  as $keyre =>$valre){
                    $contants[$keyre]['business_id']=$data['id'];
                }
                $business_contact->insert($contants);
            }
            $business->update($data);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }

    public function update(User $user, $data)
    {
        // unset($data['code']);
        $user=User::find($data['id']);
        return $user->update($data);
    }

    public function show($id){

        $info = User::where(['id'=>$id])->first();
        //获取阅读篇数
        $info['read_count']=UserRead::where(['user_id'=>$id,'status'=>'1'])->count();
       
        return $info;
    }
    //编辑次要联系人
    public function updatecontant($id,$data){
        // dump($data);die;
        return Contact::where(['id'=>$id])->update($data);
    }
    //删除次要联系人
    public function deletecontant($id){
        // dump($data);die;
        return Contact::where(['id'=>$id])->delete();
    }
    /**
     * 修改密码
     */
    public function editPassword($data){
        $datasave['password']=bcrypt($data['password']);
        return User::where(['id'=>$data['user_id']])->update($datasave);

    }
}
