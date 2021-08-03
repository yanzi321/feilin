<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class SmsRecord extends Model
{

    protected $table = 'v2_sms_record';

    public $guarded = ['id'];
}
