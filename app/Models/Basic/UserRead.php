<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;
use App\Article;
class UserRead extends Model
{
    protected $table = 'user_read';

    public $guarded = ['id'];

    public function articleInfo(){
        return $this->hasOne(Article::class,'id','article_id');
    }
    
}
