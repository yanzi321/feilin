<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{

    protected $table = 'user_message';

    public $guarded = ['id'];
    //查询相关点赞
    public function messageInfo(){
        return $this->hasOne(SystemMessage::class,'id','m_id');
    }

}
