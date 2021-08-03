<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{

    protected $table = 'v2_sms_template';

    public $guarded = ['id'];
}
