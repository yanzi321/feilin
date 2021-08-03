<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\UserCollection;
use App\Models\Basic\User;
use App\Models\Basic\Match;
use App\Models\Basic\Contact;
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
    public function addmatch($id,$data){
        $business=User::find($id);
        $save['is_match']='1';
        $save['match_id']=$data['party_b'];
        DB::beginTransaction();
        try {
            $match['party_a']=$id;
            $match['party_b']=$data['party_b'];
            $match['created_at']=now();
            $business_match = new Match();
            $business_match->insert($match);
            $business->update($save);
            //下面的撮合也要把数据保存下来
             $savey['is_match']='1';
             $savey['match_id']=$id;
             $businessy=User::find($data['party_b']);
             $businessy->update($savey);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

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
      public function updateMast(User $model, $data){
        $business=User::find($data['id']);
        //验证短信是否正确
        // if (!(new SmsService())->verifyCode($request->tel, $request->code)) {
        //     return $this->error('验证码错误');
        // }
        $savedata['contact']=$data['name'];
        $savedata['contact_tel']=$data['mobile'];
        $savedata['id']=$data['id'];
        return $business->update($savedata);
    }

    public function update(User $business, $data)
    {
        // unset($data['code']);

        return $business->update($data);
    }

    public function show($id){

        $info = User::with(['agent','contacts','order'])->where(['id'=>$id])->first();
        //判断企业有没有撮合
        $dataa = \DB::table('order_match')
            ->where('party_a', $id)
            ->count();
        $datab = \DB::table('order_match')
            ->where('party_b', $id)
            ->count();
        if ($dataa>0 || $datab>0) {
            $info->match='1';
        }else{
            $info->match='0';
        }
        return $info;
    }
    //添加次要联系人
    public function toocontacts($data){
        $data['created_at']=now();
        $data['updated_at']=now();
        return Contact::insert($data);
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
        return User::where(['id'=>$data['business_id']])->update($datasave);

    }
}
