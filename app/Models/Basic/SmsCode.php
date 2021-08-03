<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{

    protected $table = 'v2_sms_code';

    public $guarded = ['id'];
}
