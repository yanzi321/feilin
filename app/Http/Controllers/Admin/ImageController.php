<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class ImageController extends BaseController
{
    public function upload(Request $request)
    {
        $file = $request->file;
        $from = $request->from;
        $ext = $file->extension();

        // 检查文件是否有效
        if (!$file->isValid()) {
            return $this->error('无效的文件');
        }

        // 校验格式
        if (!in_array($ext, ['png', 'jpg', 'gif', 'jpeg'])) {
            return $this->error('格式不正确');
        }

        $path = $file->store($from, 'public');

        // 裁剪图片
        // TODO 裁剪图片，由于 imagecreatefromjpeg 函数问题，后期再去解决 2019年02月26日21:56:38
//        $manager = new ImageManager();
//        $image = $manager->make('storage/' . $path)->resize(150, null, function ($constraint) {
//            $constraint->aspectRatio();
//        });
//
//        $thumb = "storage/{$path}.thumb.jpg";
//        $image->save($thumb);


        $origin = "storage/{$path}";
        return $this->success([
            'origin' => asset($origin),
//            'thumb' => asset($thumb)
        ]);
    }
}
