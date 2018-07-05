<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 17:21
 */

namespace core\lib;

use \core\lib\conf;
class log
{
    /**
     * 1 确定日志存放方式
     * 2 写日志
     */
    private static $class;
    public function __construct()
    {

    }

    static public function init(){
        $driver = conf::get('driver','log');
        $class = '\core\lib\driver\log\\'.$driver;
        self::$class = new $class;
    }

    static public function log($msg,$file='log'){
        self::$class->log($msg,$file);
    }
}