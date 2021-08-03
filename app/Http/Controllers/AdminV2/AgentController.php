<?php

namespace App\Http\Controllers\AdminV2;

use Illuminate\Http\Request;
use App\Models\Basic\Agent;
use App\Http\RequestsV2\AgentRequest;
use App\ServicesV2\AgentService;

class AgentController extends BaseController
{
    protected $service;

    public function __construct(AgentService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $doctor = $this->service->collection($request->all());

        return $this->success($doctor);
    }
    public function agentIndex(){
        $info = Agent::withTrashed()
            ->where(['business_id'=>'0','states'=>'1'])->get()->toArray();
        return $this->success($info);
            
    }

    public function store(AgentRequest $request)
    {
        $query = $this->service->store($request->all());
        if ($query) {
            return $this->success($query);
        }

        return $this->error();
    }

    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    public function update(AgentRequest $request, Agent $agent)
    {
        if ($this->service->update($agent, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function destroy($id){

        $agent = Agent::withTrashed()->find($id);

        if($agent->deleted_at == NULL){
            $agent->delete();
        }else{
            $agent->restore();
        }

        return $this->success();
    }
}
