<?php


namespace App\Http\Controllers\FrontendV2;


use App\ServicesV2\OrderTransferService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Basic\OrderTransfer;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class OrderTransferController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(OrderTransferService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    public function index(Request $request)
    {
        $orders = $this->service->collection($request->all(),'0');

        return $this->success($orders);
    }
    

}
