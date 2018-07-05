<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 17:23
 */

//把日志写入文件
namespace core\lib\driver\log;

use core\lib\conf;

class file{

    private $path ; //日志存储文件位置
    public function __construct()
    {
        $option = conf::get('option','log');
        $this->path = $option['path'];
    }

    public function log($msg,$file){

        /**
         * 1 确定文件存储位置是否存在
         *   新建目录
         * 2 写入日志
         *  每个小时产生一个配置文件
         */

        $this->path = $this->path.'/'.date('YmdH');
        if(!is_dir($this->path)){
            mkdir($this->path,'0777',true);
        }
        return file_put_contents($this->path.'/'.$file.'.php',
            date('Y-m-d H:i:s').json_encode($msg).PHP_EOL,FILE_APPEND);
    }
}