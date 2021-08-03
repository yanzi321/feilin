<?php


namespace App\Models\Basic;


use Illuminate\Database\Eloquent\Model;

class Sensitive extends Model
{

    protected $table = 'sensitive';

    public $guarded = ['id'];


}
