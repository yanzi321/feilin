<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class UserNewWord extends Model
{
    protected $table = 'user_new_words';

    public $guarded = ['id'];

}
