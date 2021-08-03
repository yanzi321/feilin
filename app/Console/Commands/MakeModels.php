<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeModels extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:makeModels {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成models模版';

    //模版文件存储路径
    public function getStub()
    {
        return public_path('stub/models.stub');
    }

    //为生成文件指定命名空间
    public function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models\Basic';
    }
}
