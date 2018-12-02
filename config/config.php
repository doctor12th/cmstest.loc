<?php
/**
 * Site configs
 */

Config::set('site_name','My First CMS');

Config::set('languages',array('ru','en'));

//Routes n da settings! Also can do it with regular thing /*admin*/ or smthng like it

Config::set('routes',array(
    'default' => '',
    'admin' => 'admin_'
));

Config::set('default_route','default');
Config::set('default_language','ru');
Config::set('default_controller','pages');
Config::set('default_action','index');

/* for database */
Config::set('db_name','mvc');
Config::set('host','localhost');
Config::set('user','doctor');
Config::set('password','Azathot');

Config::set('salt','jd5jsasdk5j3lasdf45jalsd5');