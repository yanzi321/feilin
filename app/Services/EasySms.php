<?php

namespace App\Services;

class EasySms
{
    /**
     * @var self
     */
    public static $instance = null;

    /**
     * @var \Overtrue\EasySms\EasySms
     */
    protected $apapter;

    private function __construct()
    {
        $this->apapter =  new \Overtrue\EasySms\EasySms(config('sms'));
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @return \Overtrue\EasySms\EasySms
     */
    public function adapter()
    {
        return $this->apapter;
    }
}
