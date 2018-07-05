<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 16:43
 */
namespace core\lib;

class conf{

    private static $conf=array();

    static public function get($name,$file){
        /**
         * 1 判断配置文件是否存在
         * 2 判断配置是否存在
         * 3 缓存配置
         *
         */
        $file = IMOOC.'/core/config/'.$file.'.php';

        if(isset(self::$conf[$file])){
            return self::$conf[$file][$name];
        }else{
            if(is_file($file)){
                $conf = require $file;
                if(isset($conf[$name])){
                    self::$conf[$file]=$conf;
                    return $conf[$name];
                }else{
                    throw new \Exception("没有这个配置项".$name);
                }
            }else{
                throw  new \Exception("找不到配置文件！".$file);
            }
        }
    }

    static public function all($file){
        $file = IMOOC.'/core/config/'.$file.'.php';
        if(isset(self::$conf[$file])){
            return self::$conf[$file];
        }else{
            if(is_file($file)){
                $conf = require $file;
                    self::$conf[$file]=$conf;
                    return $conf;
            }else{
                throw  new \Exception("找不到配置文件！".$file);
            }
        }
    }
}