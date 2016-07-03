<?php
/**
 * Created by PhpStorm.
 * User: yuzhiqiang
 * Date: 2016/5/28
 * Time: 10:22
 */
$request = $_SERVER['QUERY_STRING'];
if(!empty($request))
{
    $parsed = explode('&', $request);
    $get_vars = array();
    foreach($parsed as $argument)
    {
        list($key, $value) = explode('=', $argument);
        $get_vars[$key] = $value;
    }
}

/*检测用户是否设置模块键名*/
if(!empty($config['module_key']))
{
    $module_key = $config['module_key'];
}
else
{
    $module_key = 'm';
}
/*检测用户是否设置控制器键名*/
if(!empty($config['controller_key']))
{
    $controller_key = $config['controller_key'];
}
else
{
    $controller_key = 'c';
}
/*检测用户是否设置操作键名*/
if(!empty($config['action_key']))
{
    $action_key = $config['action_key'];
}
else
{
    $action_key = 'a';
}

/*检测是否不存在对应模块、控制器、操作变量*/
if(!isset($get_vars[$module_key]) && !isset($get_vars[$controller_key]) && !isset($get_vars[$action_key]))
{
    $get_vars[$module_key] = 'Home';
    $get_vars[$controller_key] = 'Index';
    $get_vars[$action_key] = 'index';
}

/*判断是否存在get参数的模块和控制器*/
if(!isset($get_vars[$module_key]) || !isset($get_vars[$controller_key]) || !isset($get_vars[$action_key]))
{
    echo '404';
    return;
}


/*生成目标控制器文件路径*/
$target = APP.'/'.ucfirst($get_vars[$module_key]).'/Controller/'.ucfirst($get_vars[$controller_key]).'Controller.php';
/*判断是否存在该控制器文件*/
if(file_exists($target))
{
    require $target;
    $class = ucfirst($get_vars[$controller_key]).'Controller';
    if(class_exists($class))
    {
        $controller = new $class(APP, $get_vars[$module_key], $get_vars[$controller_key], $get_vars[$action_key], $config['debug']);//实例化具体的控制器对象
        if(method_exists($controller,$get_vars[$action_key]))
        {
            $controller->$get_vars[$action_key]();//调用控制器对象内的具体操作
        }
        else
        {
            //跳转到404页面
            echo '404';
        }
    }
    else
    {
        //跳转到404页面
        echo '404';
    }
}
else
{
    //跳转到404页面
    echo '404';
}


