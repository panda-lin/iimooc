<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/10 0010
 * Time: 下午 15:45
 */

namespace core\lib;
use \core\lib\conf;

use \Medoo\Medoo;

class model extends Medoo
{
    public function __construct()
    {
        $option = conf::all('database');
        parent::__construct($option);
    }

}