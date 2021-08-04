<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class UserShare extends Model
{
    protected $table = 'user_share';

    public $guarded = ['id'];
    //查询相关分享
    public function articleInfo(){
        return $this->hasOne(Article::class,'id','article_id');
    }

}
