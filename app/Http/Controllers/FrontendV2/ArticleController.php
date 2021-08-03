<?php


namespace App\Http\Controllers\FrontendV2;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Basic\Article;
use App\Services\ArticleService;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class ArticleController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    public function store(Request $request)
    {
        $data=$request->all();
        // $data['business_id']=$request->info->id;
        if ($this->service->store($data)) {
            return $this->success();
        }

        return $this->error();
    }
    /**
     * 编辑企业信息
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function update(Request $request,Business $business)
    {
        $data=$request->all();
        $data['id']=$request->info->id;
        if ($this->service->updateBusiness($business,$data)) {
            return $this->success();
        }

        return $this->error();
    }
     /**
     * 新闻列表
     */
    public function article(Request $request){
        $data=$request->all();
        $article= $this->service->collectionForPc($data);
        return $this->success($article);

    }
    public function show($id){
        $article= $this->service->show($id);
        return $this->success($article);
    }


}
