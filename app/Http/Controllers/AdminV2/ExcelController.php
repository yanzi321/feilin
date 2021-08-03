<?php

namespace App\Http\Controllers\AdminV2;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use App\Models\Basic\Order;
use Excel;

class ExcelController extends BaseController
{
    /**
     * 导出
     *
     * @param Users $users
     * @return mixed
     */
    public function excelExport($id,Request $request,Order $order)
    {
        //筛选条件 -- 根据需要 -- 修改你的查询语句
        $data = Order::with('businessInfo','agentInfo','receive.transfer','mortgage')->where('id',$id)->first()->toArray();
        $res= Excel::create('detail', function($excel) use ($data) {
            $excel->sheet('detail', function($sheet) use ($data)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('企业卖方名称：');   });
                $sheet->cell('B1', $data['business_info']['name']);
                $sheet->cell('C1', function($cell) {$cell->setValue('统一社会信用代码:');   });
                $sheet->cell('D1', $data['business_info']['credit_code']);
                $sheet->cell('A2', function($cell) {$cell->setValue('法定代表人：');   });
                $sheet->cell('B2', $data['business_info']['legal_person']);
                $sheet->cell('C2', function($cell) {$cell->setValue('法人身份证号：');   });
                $sheet->cell('D2', $data['business_info']['legal_idcard'].' ');
                $sheet->cell('A3', function($cell) {$cell->setValue('经办人姓名：');   });
                $sheet->cell('B3', $data['agent_info']['name']);
                $sheet->cell('C3', function($cell) {$cell->setValue('经办人电话：');   });
                $sheet->cell('D3', $data['agent_info']['mobile']);
                $sheet->cell('A4', function($cell) {$cell->setValue('经办人邮箱地址：');   });
                $sheet->cell('B4', $data['agent_email']);
                $sheet->cell('C4', function($cell) {$cell->setValue('经办人地址：');   });
                $sheet->cell('D4', $data['agent_email']);
                $sheet->cell('A5', function($cell) {$cell->setValue('贸易合同编号：');   });
                $sheet->cell('B5', $data['contract_no']);
                $sheet->cell('C5', function($cell) {$cell->setValue('日期：');   });
                $sheet->cell('D5', $data['contract_time']);
                
                if (!empty($data['receive'])) {
                    foreach ($data['receive'] as $key => $value) {
                        $i= $key+6;
                        $sheet->cell('A'.$i, function($cell) {$cell->setValue('应收账款转让内容:');   });
                        $sheet->cell('B'.$i, $value['transfer']['title']);
                        $sheet->cell('C'.$i,  function($cell) {$cell->setValue('应收账款转让金额:');   });
                        $sheet->cell('D'.$i, $value['money']);
                    }
                }else{
                    $i=6;
                }
                $sheet->cell('A'.($i+1), function($cell) {$cell->setValue('本次保理业务总金额：');   });
                $sheet->cell('B'.($i+1), $data['money']);
                $sheet->cell('C'.($i+1), function($cell) {$cell->setValue('转让期限');   });
                $sheet->cell('D'.($i+1), $data['start_time'].'至'.$data['end_time']);
                $sheet->cell('A'.($i+2), function($cell) {$cell->setValue('申请利率(年化):');   });
                $sheet->cell('B'.($i+2),$data['rate']);
                $sheet->cell('C'.($i+2), function($cell) {$cell->setValue('发票编号:');   });
                $sheet->cell('D'.($i+2),$data['invoice_number']);
                $is_confirm = $data['is_confirm'] ? '是':'否';
                $sheet->cell('A'.($i+3), function($cell) {$cell->setValue('是否确权：');   });
                $sheet->cell('B'.($i+3), $is_confirm);
                $sheet->cell('A'.($i+4), function($cell) {$cell->setValue('抵质押物：');   });
                $k=$i+5;
                if (!empty($data['mortgage'])) {
                    foreach ($data['mortgage'] as $keym => $valm) {
                        $j= $keym+$k;
                        $q= $keym+$k;
                        $sheet->cell('A'.$j, function($cell) {$cell->setValue('名称:');   });
                        $sheet->cell('B'.$j, $valm['name']);
                        $sheet->cell('C'.$j,  function($cell) {$cell->setValue('编号:');   });
                        $sheet->cell('D'.$j, $valm['number']);
                        $sheet->cell('A'.($j+1), function($cell) {$cell->setValue('评估价格:');   });
                        $sheet->cell('B'.($q+1), $valm['money']);
                        // dump($j);
                    }
                }
               
            $sheet->setWidth(array(
                                'A' => 50,
                                'B' => 50,
                                'C' => 50,
                                'D' => 50
                            ));
            });
        })->store('xls','storage');
        if ($res->filename) {
           $return['url']='/storage/'.$res->filename.'.'.$res->ext;
            return $this->success($return);
        }else{
            return $this->error();
        }
    }
}
