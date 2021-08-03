<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class ExternSalesman extends JsonResource
{
    public function toArray($request)
    {
        $additional = [
            'qrcode_link' => $this->genQrcodeLink()
        ];

        return array_merge(parent::toArray($request), $additional);
    }

    private function genQrcodeLink()
    {
        $baseLink = 'https://www.steptousa.cn/sign_up/index.html?';
        $query = http_build_query([
            'extern_salesman' => Crypt::encrypt($this->id)
        ]);

        return $baseLink . $query;
    }
}
