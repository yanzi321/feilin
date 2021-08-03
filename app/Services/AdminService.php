<?php
/**
 * 管理员 admin 相关接口
 * User: rovast
 * Date: 2019-01-26
 * Time: 21:55
 */

namespace App\Services;


use App\Admin;
use App\Exceptions\ErrorException;
use App\Http\Resources\AdminCollection;
use App\Role;
use Illuminate\Support\Facades\Hash;

class AdminService extends BaseService
{
    /**
     * 获取管理员列表
     * @return AdminCollection|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function collection()
    {
        $admins = Admin::with('roles:id,name')->get();
        $admins = new AdminCollection($admins);
        return $admins;
    }

    /**
     * 删除管理员
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Admin::destroy($id);
    }

    /**
     * 创建管理员
     * @param Admin $admin
     * @param Role $role
     * @return Admin
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (!isset($data['role_id']) || empty($data['role_id'])) {
            throw new ErrorException('请选择管理员角色');
        }

        $role = Role::find(intval($data['role_id']));
        unset($data['role_id']);
        if (!$role) {
            throw new ErrorException('角色信息有误');
        }

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        $admin = Admin::create($data);
        if (!$admin) {
            throw new ErrorException('管理员信息保存失败！');
        }

        return $admin->syncRoles([$role]);
    }

    public function update(Admin $admin, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $admin->update($data);
        }

        if (!isset($data['role_id']) || empty($data['role_id'])) {
            throw new ErrorException('请选择管理员角色');
        }

        $role = Role::find(intval($data['role_id']));
        if (!$role) {
            throw new ErrorException('角色信息有误');
        }

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        if ($data['tel'] != $admin->tel) {
            if (Admin::where('tel', $data['tel'])->count()){
                throw new ErrorException('该手机号已被占用');
            }
        }

        if ($data['email'] != $admin->email) {
            if (Admin::where('email', $data['email'])->count()){
                throw new ErrorException('该邮箱已被占用');
            }
        }

        unset($data['role_id']);
        unset($data['roles']);
        $res = $admin->update($data);
        if (!$res) {
            throw new ErrorException('管理员信息保存失败！');
        }

        return $admin->syncRoles([$role]);
    }
}
