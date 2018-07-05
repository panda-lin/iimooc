<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 15:12
 */

namespace app\ctrl;

use app\model\UserModel;
use \core\lib\basecontroller;

class indexCtrl extends basecontroller
{
    public function index(){
//        form_print("index ctrl");
//        $userModel = new UserModel();
//        $users = $userModel->lists();
//        $users = $userModel->getOne(3);
//        dump($users);
        $data = 'Hello world';
        $title = '这是一个视图文件';
        $this->assign('data',$data);
        $this->assign('title',$title);
        $this->display('index.html');
    }
}