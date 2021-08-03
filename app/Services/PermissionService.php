<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-27
 * Time: 21:47
 */

namespace App\Services;


use App\Exceptions\ErrorException;
use App\Http\Resources\PermissionCollection;
use App\Permission;

class PermissionService
{
    /**
     * @param null $params
     * @return PermissionCollection
     */
    public function collection($params = null)
    {
        $permissions = new PermissionCollection(Permission::orderBy('tag')->get());

        return $permissions;
    }

    public function update(Permission $permission, $data)
    {
        return $permission->update($data);
    }

    /**
     * @param array $data
     * @return Permission|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Permission::create($data);
    }
}
