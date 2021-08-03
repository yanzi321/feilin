<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'business_order';

    public $guarded = ['id'];
    //抵押物
    public function mortgage(){
        return $this->hasMany(Mortgage::class,'order_id','id');
    }
    //企业应收款内容
    public function receive()
    {
        return $this->hasMany(Receive::class,'order_id','id');
    }

    //相关合同模板
    public function contract()
    {
        return $this->hasOne(ETemplate::class, 'id', 'template_id')->select(['id', 'name']);
    }

    public function businessInfo(){
        return $this->hasOne(Business::class,'id','business_id');
    }

    public function agentInfo(){
        return $this->hasOne(Agent::class,'id','agent_id');
    }

    public function platformAgentInfo(){
        return $this->hasOne(Agent::class,'id','platform_agent_id');

    }
    //相关公司信息
    public function business(){
        return $this->hasOne(Business::class,'id','business_id');
    }
    //相关日志
    public function orderlogs(){
        return $this->hasMany(OrderLogs::class,'order_id','id');
    }
}
