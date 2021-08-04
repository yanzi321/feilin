<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class UserEnshrine extends Model
{
    protected $table = 'user_enshrine';

    public $guarded = ['id'];
    //查询相关收藏
    public function articleInfo(){
        return $this->hasOne(Article::class,'id','article_id');
    }
    
}
