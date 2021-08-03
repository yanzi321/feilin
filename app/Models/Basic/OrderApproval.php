<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class OrderApproval extends Model
{
    protected $table = 'business_order_approval';

    public $guarded = ['id'];

    public function businessInfo(){
        return $this->hasOne(Business::class,'id','business_id');
    }
    public function orderInfo(){
        return $this->hasOne(Order::class,'id','order_id');
    }
    
}
