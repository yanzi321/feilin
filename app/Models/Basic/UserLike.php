<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{

    protected $table = 'user_like';

    public $guarded = ['id'];

}
