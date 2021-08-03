<?php

namespace App\Http\Controllers;

use App\Mail\NewActivity;
use App\Mail\NewPartnerApply;
use App\User;

class TestController extends Controller
{
    public function send()
    {
        return \Mail::to('global_group@steptousa.com')->send(new NewPartnerApply(User::find(2)));
    }

    public function email()
    {
        dd(123);
        if ($_GET['a']) {
            return (new NewActivity(User::find(10000)))->render();
        }
        return (new NewPartnerApply(User::find(1)))->render();
    }

    public function getContent($path){
        return response()->file(storage_path().'/app/public/'.$path);
    }
}
