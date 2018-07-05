<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 上午 9:48
 */

namespace core;

//require CORE.'/Route.php';

use \core\lib\log;

class Imooc
{
    public static $classMap = array();

    public $assign;

    public function __construct()
    {
//        form_print("Imooc");
    }

    static public function run(){
        log::init();
        $route = new \core\lib\route();
        $ctrlClass = $route->getCtrl();
        $actionMethod = $route->getAction();

        $ctrlClass.="Ctrl";
        $ctrlFile = APP.'/ctrl/'.$ctrlClass.'.php';
        if(is_file($ctrlFile)){
            include $ctrlFile;
            $ctrlClass = '\\'.MODULE.'\\ctrl\\'.$ctrlClass;
            $ctrl = new $ctrlClass();
            $ctrl->$actionMethod();
            log::log("  ctrlClass:".$ctrlClass."  actionMethod:".$actionMethod);
        }else{
            throw new \Exception("控制器【".$ctrlClass."】找不到");
        }
    }

    static public function load($class){
        //自动加载类库
        if(isset(self::$classMap[$class])){ // core\Route
            return true;
        }else {
//            form_print("load");
            $PHPFile = IMOOC.'/'.$class . '.php';
            if (is_file($PHPFile)) {
                include $PHPFile;
                self::$classMap[$class] =$class;
                return true;
            } else {
                return false;
            }
        }
    }

    public function assign($name,$value){
        $this->assign[$name] = $value;
    }

    public function display($file){
//        $file = APP.'/views/'.$file;
        if(is_file(APP.'/views/'.$file)){
            $loader = new \Twig_Loader_Filesystem(APP.'/views/');
            $twig = new \Twig_Environment($loader, array(
                'cache' => IMOOC.'/cache/',
            ));
            echo $twig->render($file, $this->assign?$this->assign:'');
        }
    }
}