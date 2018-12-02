<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('VIEW_PATH',ROOT.DS.'views');

require_once(ROOT.DS.'lib'.DS.'init.php');

try{
    session_start();
    App::run($_SERVER['REQUEST_URI']);
   }
catch(Exception $e)
{
    require(VIEW_PATH.DS.'404.html');
}