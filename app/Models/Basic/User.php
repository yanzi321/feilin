<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public $guarded = ['id'];
    //企业经办人
    public function share(){
        return $this->hasMany(Share::class,'user_id','id');
    }
    //次要联系人
    public function task(){
        return $this->hasMany(Contact::class,'user_id','id');
    }
    //企业业务
    public function order(){
        return $this->hasMany(Order::class,'user_id','id')->select(['id','status','sign_no','business_id'])->orderBy('id','desc')->where('status', '<>', 0)->limit(2);
    }
    
}
