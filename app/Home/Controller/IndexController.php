<?php
/**
 * Created by PhpStorm.
 * User: yuzhiqiang
 * Date: 2016/5/28
 * Time: 13:44
 */

class IndexController extends Controller{

    public function index()
    {
        $this->assign('test','fuck');
        $this->display();
    }

    public function test()
    {
        $this->display();
    }
}