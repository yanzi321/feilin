<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class OrderLogs extends Model
{
    protected $table = 'order_logs';

    public $guarded = ['id'];
    
}
