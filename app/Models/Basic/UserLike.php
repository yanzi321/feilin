<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{

    protected $table = 'user_like';

    public $guarded = ['id'];
    //查询相关点赞
    public function articleInfo(){
        return $this->hasOne(Article::class,'id','article_id');
    }

}
