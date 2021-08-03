<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;
use function GuzzleHttp\Psr7\build_query;

class Organization extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $additional = [
            'images' => \json_decode($this->images),
            'qrcode_link' => $this->genQrcodeLink()
        ];

        return array_merge(parent::toArray($request), $additional);
    }

    private function genQrcodeLink()
    {
        $baseLink = 'https://www.steptousa.cn/sign_up/index.html?';
        $query = http_build_query([
            'org' => Crypt::encrypt($this->id)
        ]);

        return $baseLink . $query;
    }
}
