<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class MakeRequests extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:makeRequests {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成request模版';

    //模版文件存储路径
    public function getStub()
    {
        return public_path('stub/requests.stub');
    }

    //为生成文件指定命名空间
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\RequestsV2';
    }
}
