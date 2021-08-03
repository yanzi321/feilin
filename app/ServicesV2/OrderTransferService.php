<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\OrderTransferCollection;
use App\Models\Basic\OrderTransfer;
use DB;

class OrderTransferService
{

    public function collection($params = null,$isflage='0')
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'asc';
        $status = $params['status'] ?? '1';
        // dump($business_id);
        if ($isflage=='1') {
            $info = OrderTransfer::orderBy('id',$sort)
                ->paginate($size);
        }else{
            $info = OrderTransfer::orderBy('id','desc')->get();
            $info = new OrderTransferCollection($info);
        }
        

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }
        
        return OrderTransfer::create($data);
    }
 

    public function update(OrderTransfer $orderTransfer,$data)
    {
        return $orderTransfer->update($data);
    }

}
