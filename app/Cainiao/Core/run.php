<?php
/**
 * Created by PhpStorm.
 * User: yuzhiqiang
 * Date: 2016/5/28
 * Time: 9:40
 */



require_once SOURCE.'/Core/Controller.php';//引入controller父类
$config = require SOURCE.'/Conf/config.php';

if(!$config['debug'])
{
    error_reporting(E_NOTICE | E_WARNING);
}
require '/route.php';




