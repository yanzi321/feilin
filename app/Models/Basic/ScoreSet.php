<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class ScoreSet extends Model
{
    protected $table = 'score_set';

    public $guarded = ['id'];
    //查询相关分享
    // public function articleInfo(){
    //     return $this->hasOne(Article::class,'id','article_id');
    // }

}
