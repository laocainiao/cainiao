<?php
/**
 * Created by PhpStorm.
 * User: yuzhiqiang
 * Date: 2016/5/28
 * Time: 9:33
 */
class Template
{
    protected $left_tag        = '{';
    protected $right_tag       = '}';
    protected $compile_dir     =  '';
    protected $template_dir    =  '';
    protected $caching         =  false;
    protected $tpl_vars        =  array();
    protected $action        =  '';

    protected function check_dir()
    {
        if(!is_dir($this->template_dir))
        {
            mkdir($this->template_dir ,0755);
        }
        if(!is_dir($this->compile_dir))
        {
            mkdir($this->compile_dir ,0755);
        }
    }

    private function parse($file, $compile_file)
    {
        $content = file_get_contents($file);
        $pattern = '/\{\$([\w\d]+)\}/';
        if(preg_match($pattern, $content))
        {
            $content = preg_replace($pattern, '<?php echo $this->tpl_vars["$1"] ?>', $content);
        }
        file_put_contents($compile_file, $content);
    }

    public function assign($key_name, $key_value)
    {
        $this->tpl_vars[$key_name] = $key_value;
    }

    public function display($file = null)
    {

        if($file === null)
        {
            $file = $this->action;
        }
        $file = $this->template_dir.'/'.$file.'.html';
        $compile_file = $compile_file = $this->compile_dir.'/'.md5($this->action).'.php';
        if(file_exists($file))
        {
            if($this->caching)
            {
                if(!file_exists($compile_file) || filemtime($compile_file) < filemtime($file))
                {
                    $this->parse($file, $compile_file);
                }
            }
            else
            {
                $this->parse($file, $compile_file);
            }
            require $compile_file;
        }
        else
        {
            //跳转到404页面
            echo '404';
            return;
        }
        //require $file;
    }


}
