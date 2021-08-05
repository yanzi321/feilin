<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $table = 'user_score';

    public $guarded = ['id'];
    //查询相关分享
    public function scoreInfo(){
        return $this->hasOne(ScoreSet::class,'id','gain_id');
    }

}
