<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 上午 9:51
 */

namespace core\lib;

use core\lib\conf;
class route
{
    private $ctrl;

    /**
     * @return string
     */
    public function getCtrl()
    {
        return $this->ctrl;
    }

    private $action;

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    public function __construct()
    {
//        form_print("Route");
        /**
         * 1.隐藏index.php入口文件
         * 2.获取url参数部分
         * 3.返回对应控制器的方法
         */
//        form_print($_SERVER);
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {
            $uri = $_SERVER['REQUEST_URI'];
            $uri = substr($uri, 0, strpos($uri, '?') != false ? strpos($uri, '?') : strlen($uri));
            $uriArr = explode('/', trim($uri, '/'));
            if (isset($uriArr[0])) {
                $this->ctrl = $uriArr[0];
            }
            unset($uriArr[0]);
            if (isset($uriArr[1])) {
                $this->action = $uriArr[1];
                unset($uriArr[1]);
            } else {
                $this->action = conf::get('ACTION','route');
            }
//            form_print($uriArr);
            //满足偶数个，同时，键值对形式，键必须是字符串
            $count = count($uriArr) + 2;
            $i = 2;
            while ($i < $count) {
                if (isset($uriArr[$i + 1])) {
//                    if(!preg_match_all('/^\\s{1}\\w+$/i',$uriArr[$i])){
//                        throw new \Exception('请求路径错误！参数名key【'.$uriArr[$i].'】错误！');
//                    }
                    $_GET[$uriArr[$i]] = $uriArr[$i + 1];
                }
                $i += 2;
            }
        } else {
            $this->ctrl = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }
    }

}