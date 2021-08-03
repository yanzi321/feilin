<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-26
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Basic\OperationLog;

class AuthController extends BaseController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return AuthController|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('admin')->attempt($credentials)) {
            return $this->error('邮箱或密码有误');
        }

        if (auth('admin')->user()->status == 0) {
            return $this->error('此账号已被禁用，请联系管理员');
        }
        $this->postLogin($request);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function info()
    {
        $user = auth('admin')->user();
        $roles = $user->roles->map(function ($role) {
            $role->permission_names = $role->permissions->map(function ($permission) {
                return [
                    'tag' => $permission->tag,
                    'name' => $permission->name,
                    'display_name' => $permission->display_name,
                ];
            });
            $role->permission_groups = $role->permission_names->groupBy('tag');
            unset($role->permissions);
            unset($role->pivot);
            return $role;
        });

        return $this->success([
                'id' => $user->id,
                'name' => $user->name,
                'roles' => $roles,
                'roles_name' => $roles[0],
                'avatar' => 'http://www.mufan.co/images/design.png'
            ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return $this->success('退出成功');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('admin')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60
        ]);
    }
    public function postLogin(Request $request)
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

}
