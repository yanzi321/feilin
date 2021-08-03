<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Basic\OperationLog;

class AdminOperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            $user = auth('admin')->user();
            if (isset($user->roles)) {
                // dd($user);
                $role=[];

                $role=$user->roles->toArray();
                foreach ($role as $key => $value) {
                    $role_name=$value['display_name'];
                }
                $user_id=$user->id;
            }
            // dd($request->path());
            //只记录登录日志
        if('api/admin/auth/info' == $request->path()){
            $input = $request->all();
            $log = new OperationLog(); # 提前创建表、model
            $log->uid = $user_id;
            $log->name = $user->name;
            $log->role_name = $role_name;
            $log->path = $request->path();
            $log->method = $request->method();
            $log->ip = $request->ip();
            $log->sql = '';
            $log->input = json_encode($input, JSON_UNESCAPED_UNICODE);
            $log->save();   # 记录日志
        }
        return $next($request);
    }
}
