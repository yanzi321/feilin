<?php

namespace App\ServicesV2;

use App\Models\Basic\User;
use App\ServicesV2\FrontendJwtService;
use Illuminate\Support\Facades\Hash;

class FrontendService
{
    protected $app;


    public function login(array $data)
    {
        $mobile = $data['mobile'] ?? '';

        $info = User::when($mobile, function ($query, $mobile) {
            return $query->where('mobile', '=', "$mobile");
        })->first();
        if($info == NULL || !Hash::check($data['password'],$info->password)){
            return ['query'=>false,'msg'=>'用户名或密码错误'];
        }

        return [
            'query' => true,
            'token' => FrontendJwtService::getInstance()->getJwtToken(['legal_tel'=>$info->legal_tel,'id'=>$info->id]),
            'token_type' => 'bearer',
        ];
    }
}
