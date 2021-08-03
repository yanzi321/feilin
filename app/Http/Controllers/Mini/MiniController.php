<?php

namespace App\Http\Controllers\Mini;

use App\Services\MiniService;
use Illuminate\Http\Request;

class MiniController extends BaseController
{
    protected $service;

    public function __construct(MiniService $miniService)
    {
        $this->service = $miniService;
    }

    public function wxacode(Request $request)
    {
        $this->validate($request, [
           'path' => 'required',
           'scene' => 'required',
           'width' => 'integer',
        ]);

        return $this->service->wxacode($request->input('path'), $request->input('scene'), $request->input('width', 600));
    }
}
