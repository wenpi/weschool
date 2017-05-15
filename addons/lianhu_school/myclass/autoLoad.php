<?php 
//自动加载函数
require("func.php");
function classExists($class_name){
    global $__Global_class;
    if(isset($__Global_class[$class_name])){
        return $__Global_class[$class_name];
    }else{
        $out = false;
    }
}
function setClassExists($class_name,$class){
    global $__Global_class;
    $__Global_class[$class_name] = $class;
}

function myClassLoader($class){
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = str_replace("myclass",'',$path);
    $file = __DIR__ . '/' . $path . '.php';
    if (file_exists($file)){
        require_once $file;
    }
} 

spl_autoload_register('myClassLoader');

function D($class_name){
    $class_name  = 'myclass\\src\\'.$class_name;
    $re          = classExists($class_name);
    if($re){
        $class   = $re;
    }else{
        $class   = new $class_name;
        setClassExists($class_name,$class);
    }
    return $class;
}
function C($class_name){
    $class_name  = 'myclass\\ctl\\'.$class_name;
    $re          = classExists($class_name);
    if($re){
        $class   = $re;
    }else{
        $class   = new $class_name;
        setClassExists($class_name,$class);
    }
    return $class;
}
//中间库
function M($class_name){
    if(USE_MIDDLE==1){
            $old_class_name = $class_name;
            $class_name  = 'myclass\\middle\\'.$class_name;
            $re          = classExists($class_name);
            if($re){
                $class   = $re;
            }else{
                require_once("middle/".$old_class_name.'.php');
                $class   = new $class_name;
                setClassExists($class_name,$class);
            }
        return $class;
    }
    return false;
}
//调用各种类的集合方式
//Au('jiacard/class_name')
function Au($class_name){
    $arr             = explode('/',$class_name);
    $file_name       = $arr[0];
    $real_class_name = $arr[1];
    $do_class_name   = 'myclass\\'.$file_name.'\\'.$real_class_name;
    $file_local      = __DIR__."/".$file_name.'/'.$real_class_name.'.php';
    $re              = classExists($do_class_name);
    if($re){
        $class = $re;
    }else{
        if(file_exists($file_local)){
            require_once($file_local);
            $class   = new $do_class_name;
            setClassExists($do_class_name,$class);            
        }else{
            $class = false;
        }
    }
    return $class;
}

//调用静态 src
function S($class_name,$function,$params){
      $class_name  = 'myclass\\src\\'.$class_name;
      if(empty($params) || !is_array($params)){
          $params = array();
      }
      $result      = call_user_func_array(array($class_name,$function),$params);
      return  $result;
}
function ST($class_name,$function,$params){
      $class_name  = 'myclass\\ctl\\'.$class_name;
      if(empty($params) || !is_array($params)){
          $params = array();
      } 
      $result      = call_user_func_array(array($class_name,$function),$params);
      return  $result;
}
function MT($class_name,$function,$params){
    if(USE_MIDDLE==1){
            require_once("middle/".$class_name.'.php');
            $class_name = 'myclass\\middle\\'.$class_name;
            if(empty($params) || !is_array($params)){
                $params = array();
            }            
            $result     = call_user_func_array(array($class_name,$function),$params);
            return $result;
    }else{
            return false;
    }
}
//中间库
$file_have = file_exists(__DIR__.'/middle/require.php');
if($file_have){
    require('middle/require.php');
}