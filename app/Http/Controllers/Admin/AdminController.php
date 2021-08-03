<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-26
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;


use App\Admin;
use App\Exceptions\ErrorException;
use App\Http\Requests\CreateAdmin;
use App\Http\Requests\UpdateAdmin;
use App\Services\AdminService;

class AdminController extends BaseController
{
    /**
     * @var AdminService
     */
    protected $service;

    public function __construct(AdminService $adminService)
    {
        $this->service = $adminService;
    }

    public function index()
    {
        $tags = $this->service->collection();
        return $this->success($tags);
    }

    /**
     * @param CreateAdmin $request
     * @return AdminController|\Illuminate\Http\JsonResponse
     * @throws ErrorException
     */
    public function store(CreateAdmin $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param Admin $admin
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function show(Admin $admin)
    {
        if (!$admin) {
            return $this->error();
        }

        $admin->role_id = $admin->roles->map(function ($tag) {
            return $tag['id'];
        })->first();

        $data = new \App\Http\Resources\Admin($admin);

        return $this->success($data);
    }

    /**
     * @param UpdateAdmin $request
     * @param Admin $admin
     * @return AdminController|\Illuminate\Http\JsonResponse
     * @throws ErrorException
     */
    public function update(UpdateAdmin $request, Admin $admin)
    {
        if ($this->service->update($admin, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function info()
    {
        return $this->success([
            'roles' => ['editor', 'admin'],
            'name' => 'rovast',
            'avatar' => 'https://ss2.baidu.com/6ONYsjip0QIZ8tyhnq/it/u=2764854512,2770204853&fm=58&bpow=580&bpoh=659'
        ]);
    }

    /**
     * @param Admin $admin
     * @return AdminController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        if ($admin->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
