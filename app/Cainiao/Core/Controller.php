<?php
/**
 * Created by PhpStorm.
 * User: yuzhiqiang
 * Date: 2016/5/28
 * Time: 9:26
 */
require LIBRARY.'/Template/Template.php';
class Controller extends  Template{

    /*
     * $app:站点根目录
     * $module:模块名称，对应到同名的缓存目录
     * $controller:控制器名称，对应到同名的模版目录
     * */
    public function __construct($app,$module,$controller,$action,$debug)
    {
        $this->template_dir = $app.'/'.$module.'/View/'.ucfirst($controller);
        $this->compile_dir = $app.'/Runtime/'.$module;
        $this->action = $action;
        $this->caching = $debug;
        $this->check_dir();
    }

    public function not_fount()
    {
        echo 'test';
        $this->template_dir = '';
    }
}