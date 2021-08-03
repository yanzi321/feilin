<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeServices extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:makeServices {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成services模版';

    //模版文件存储路径
    public function getStub()
    {
        return public_path('stub/services.stub');
    }

    //为生成文件指定命名空间
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\ServicesV2';
    }
}
