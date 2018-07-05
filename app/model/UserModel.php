<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 20:03
 */

namespace app\model;

use core\lib\model;

class UserModel extends model
{
    private $table = 'user';
    public function lists(){
        $res = $this->select($this->table,'*');
        return $res;
    }

    public function getOne($id){
        $res = $this->get($this->table,'*',array(
            'id' => $id
        ));
        return $res;
    }
}