<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class OperationLog extends Model
{
    protected $table = 'operation_log';

    public $guarded = ['id'];
    
}
