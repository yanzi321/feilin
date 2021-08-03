<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $insertArr = [
            // 首页
            ['tag' => 'dashboard', 'name' => 'dashboard.index', 'display_name' => '首页', 'created_at' => $now, 'updated_at' => $now],

            // 系统设置
            ['tag' => 'system', 'name' => 'admin.index', 'display_name' => '管理员列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'admin.show', 'display_name' => '管理员详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'admin.store', 'display_name' => '添加管理员', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'admin.destroy', 'display_name' => '删除管理员', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'admin.update', 'display_name' => '修改管理员', 'created_at' => $now, 'updated_at' => $now],

            ['tag' => 'system', 'name' => 'role.index', 'display_name' => '角色列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'role.show', 'display_name' => '角色详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'role.store', 'display_name' => '添加角色', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'role.destroy', 'display_name' => '删除角色', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'role.update', 'display_name' => '修改角色', 'created_at' => $now, 'updated_at' => $now],

            ['tag' => 'system', 'name' => 'permission.index', 'display_name' => '权限列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'permission.show', 'display_name' => '权限详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'permission.store', 'display_name' => '添加权限', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'permission.destroy', 'display_name' => '删除权限', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'system', 'name' => 'permission.update', 'display_name' => '修改权限', 'created_at' => $now, 'updated_at' => $now],

            // 碎片管理
            ['tag' => 'piece', 'name' => 'piece_model.index', 'display_name' => '碎片模型列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece_model.show', 'display_name' => '碎片模型详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece_model.store', 'display_name' => '添加碎片模型', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece_model.destroy', 'display_name' => '删除碎片模型', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece_model.update', 'display_name' => '修改碎片模型', 'created_at' => $now, 'updated_at' => $now],

            ['tag' => 'piece', 'name' => 'piece.index', 'display_name' => '碎片列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece.show', 'display_name' => '碎片详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece.store', 'display_name' => '添加碎片', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece.destroy', 'display_name' => '删除碎片', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'piece', 'name' => 'piece.update', 'display_name' => '修改碎片', 'created_at' => $now, 'updated_at' => $now],

            // 订单管理
            ['tag' => 'order', 'name' => 'order.index', 'display_name' => '订单列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order', 'name' => 'order.show', 'display_name' => '订单详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order', 'name' => 'order.update', 'display_name' => '修改订单', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order', 'name' => 'order.examine_order', 'display_name' => '审核订单', 'created_at' => $now, 'updated_at' => $now],
             //添加易签保信息
            ['tag' => 'order', 'name' => 'order.create-by-template', 'display_name' => '通过模板创建文件', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order', 'name' => 'order.create-flow-one-step', 'display_name' => '一步发起签署', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order', 'name' => 'order.dowload-documents', 'display_name' => '获取下载文档地址', 'created_at' => $now, 'updated_at' => $now],

            //审批列表
            ['tag' => 'order-approval', 'name' => 'order-approval.index', 'display_name' => '审批列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-approval', 'name' => 'order-approval.show', 'display_name' => '审批详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-approval', 'name' => 'order-approval.store', 'display_name' => '发起审批', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-approval', 'name' => 'order-approval.update', 'display_name' => '修改审批', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-approval', 'name' => 'order-approval.examin-approval', 'display_name' => '审核审批', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-approval', 'name' => 'order_approval.loan', 'display_name' => '财务上传凭证', 'created_at' => $now, 'updated_at' => $now],
           



            // 企业管理
            ['tag' => 'business', 'name' => 'business.index', 'display_name' => '企业列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.show', 'display_name' => '企业详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.store', 'display_name' => '添加企业', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.update', 'display_name' => '修改企业', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.create_contact', 'display_name' => '添加次要联系人', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.update_contact', 'display_name' => '编辑次要联系人', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'business', 'name' => 'business.delete_contact', 'display_name' => '删除次要联系人', 'created_at' => $now, 'updated_at' => $now],
            //企业管理添加联系人
            ['tag' => 'business', 'name' => 'business.examine-business', 'display_name' => '审核企业', 'created_at' => $now, 'updated_at' => $now],
            //经办人管理
            ['tag' => 'agent', 'name' => 'agent.index', 'display_name' => '经办人列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'agent', 'name' => 'agent.show', 'display_name' => '经办人详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'agent', 'name' => 'agent.store', 'display_name' => '添加经办人', 'created_at' => $now, 'updated_at' => $now],
            //合同模板管理
            ['tag' => 'e-template', 'name' => 'e-template.index', 'display_name' => '合同模板列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'e-template', 'name' => 'e-template.show', 'display_name' => '合同模板详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'e-template', 'name' => 'e-template.store', 'display_name' => '添加合同模板', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'e-template', 'name' => 'e-template.update', 'display_name' => '修改合同模板', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'e-template', 'name' => 'e-template.doc', 'display_name' => '获取模板信息', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'e-template', 'name' => 'e-template.do', 'display_name' => '下载模板', 'created_at' => $now, 'updated_at' => $now],

            // 短信模板管理
            ['tag' => 'sms-template', 'name' => 'sms-template.index', 'display_name' => '短信模板列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'sms-template', 'name' => 'sms-template.show', 'display_name' => '短信模板详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'sms-template', 'name' => 'sms-template.store', 'display_name' => '添加短信模板', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'sms-template', 'name' => 'sms-template.update', 'display_name' => '修改短信模板', 'created_at' => $now, 'updated_at' => $now],

            // 短信管理
            ['tag' => 'sms-record', 'name' => 'sms-record.index', 'display_name' => '短息列表', 'created_at' => $now, 'updated_at' => $now],
        
            // 二次转让列表
            ['tag' => 'transfer', 'name' => 'transfer.index', 'display_name' => '二次转让列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'transfer', 'name' => 'transfer.update', 'display_name' => '二次转让详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'transfer', 'name' => 'transfer.make_over', 'display_name' => '添加二次转让', 'created_at' => $now, 'updated_at' => $now],
            //应收款转让内容
            ['tag' => 'order-transfer', 'name' => 'order-transfer.index', 'display_name' => '应收款转让列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-transfer', 'name' => 'order-transfer.store', 'display_name' => '添加应收款转让', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'order-transfer', 'name' => 'order-transfer.update', 'display_name' => '修改应收款转让', 'created_at' => $now, 'updated_at' => $now],

            // 撮合列表
            ['tag' => 'match', 'name' => 'match.index', 'display_name' => '撮合列表', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'match', 'name' => 'match.show', 'display_name' => '撮合详情', 'created_at' => $now, 'updated_at' => $now],
            ['tag' => 'match', 'name' => 'match.addmatch', 'display_name' => '添加撮合', 'created_at' => $now, 'updated_at' => $now],
           
        ];

        DB::table('permissions')->insert($insertArr);
    }
}
