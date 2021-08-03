<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-27
 * Time: 21:46
 */

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePermission;
use App\Http\Resources\PermissionCollection;
use App\Permission;
use App\Services\PermissionService;

class PermissionController extends BaseController
{
    /**
     * @var PermissionService
     */
    protected $service;

    public function __construct(PermissionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $permissions = $this->service->collection();

        return $this->success($permissions);
    }

    public function update(CreatePermission $request, Permission $permission)
    {
        if ($this->service->update($permission, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function store(CreatePermission $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * @param Permission $permission
     * @return PermissionController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Permission $permission)
    {
        if ($permission->delete()) {
            return $this->success();
        }

        return $this->error();
    }

    public function group()
    {
        $permissions = Permission::all();
        $permissions = $permissions->groupBy('tag')->map(function ($items, $tag) {
            return [
                'tag' => $tag,
                'items' => $items
            ];
        })->values();

        return $this->success($permissions);
    }
}
