<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-26
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateRole;
use App\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Http\Resources\Role as RoleResource;

class RoleController extends BaseController
{
    /**
     * @var RoleService
     */
    protected $service;

    public function __construct(RoleService $roleService)
    {
        $this->service = $roleService;
    }

    public function index()
    {
        $tags = $this->service->collection();

        return $this->success($tags);
    }

    public function store(CreateRole $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function show($id)
    {
        $role = Role::with('permissions:id,name')
            ->select(['id', 'name', 'display_name', 'description'])
            ->find($id);

        return $this->success($role);
    }

    /**
     * @param CreateRole $request
     * @param Role $role
     * @return RoleController|\Illuminate\Http\JsonResponse
     */
    public function update(CreateRole $request, Role $role)
    {
        if ($this->service->update($role, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RoleController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePermissions(Request $request, Role $role)
    {
        $this->validate($request, [
            'permissions' => 'required|array'
        ]);

        if (empty($role)) {
            return $this->error('role not found');
        }

        if ($this->service->updatePermissions($role, $request->permissions)) {
            return $this->success();
        }

        return $this->error();
    }
}
