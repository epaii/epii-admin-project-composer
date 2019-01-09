<?php
/**
 * User: hey
 * Date: 2019/1/8
 * Time: 11:12
 * 通用函数
 */

if(!function_exists('url')){
    /**
     * 生成url
     * @param string $url
     * @param array $param
     * @return string
     */
    function url($url = '',array $param = []){
        if(!empty($param)){
            $param_str = '&';
            foreach ($param as $k => $v){
                $param_str .= $k."=".urlencode($v)."&";
            }
            $param_str = rtrim($param_str,"&");
        }else{
            $param_str = '';
        }

        if(strpos($url,'/') !== false){
            $url_arr = explode("/",$url);
            $class = $url_arr[0];
            $function = $url_arr[1];
        }else{
            $class = $url;
            $function = 'index';
        }
        return "?app=".$class."@".$function.$param_str;
    }
}


if (!function_exists('redirect')){
    /**
     * @param string $url
     * @param array $param
     * 跳转至指定的URL
     */
    function redirect($url = '',array $param = [])
    {
        $redirect_url = url($url, $param);
        header('location:' . $redirect_url);
    }

}

