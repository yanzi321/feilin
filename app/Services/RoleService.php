<?php

namespace App\Services;

use App\Exceptions\ErrorException;
use App\Http\Resources\RoleCollection;
use App\Role;

class RoleService
{
    /**
     * 获取管理员列表
     * @return RoleCollection
     */
    public function collection($params = null)
    {
        $roles = new RoleCollection(Role::all());

        return $roles;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Role::create($data);
    }

    public function update(Role $role, $data)
    {
        return $role->update($data);
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @return array
     * @throws ErrorException
     */
    public function updatePermissions(Role $role, array $permissions = [])
    {
        if (empty($permissions)) {
            throw new ErrorException('got empty permissions');
        }

        return $role->syncPermissions($permissions);
    }
}
