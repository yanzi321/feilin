<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;
use App\Category;
class userColumn extends Model
{
    protected $table = 'user_column';

    public $guarded = ['id'];

    public function categoriesInfo(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    
}
