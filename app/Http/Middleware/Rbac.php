<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Traits\ApiResponse;
use Closure;
use Doctrine\Common\Inflector\Inflector;

class Rbac
{
    use ApiResponse;

    /**
     * @var Admin
     */
    private $admin = null;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //  如果是超级管理员，直接放行啦
        if ($this->isSuperAdmin()) {
            return $next($request);
        }

        // 接下来就是判断权限了呢
        $route_name = $request->route()->getName();

        // 如果是复数(laravel route)的路由名称，需要转成单数(permission name)
        $split = explode('.', $route_name);
        if (count($split) > 1) {
            $split[0] = Inflector::singularize($split[0]);
            $route_name = implode('.', $split);
        }

        if ($this->getAdmin()->hasPermission($route_name)) {
            return $next($request);
        }

        return $this->error(sprintf('暂无权限访问，请联系管理员 %s', $route_name));
    }

    private function isSuperAdmin()
    {

        return $this->getAdmin()->hasRole('super-admin');
    }

    private function getAdmin()
    {
        if (empty($this->admin)) {
            $this->admin = auth('admin')->user();
        }

        return $this->admin;
    }
}
