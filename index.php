<?php
	//header('Content-Type: text/html; charset=utf-8');
	//应用名称
	define("SITE_PATH", dirname(__FILE__).'/Apps/');
	define('THINK_PATH', dirname(__FILE__) . '/ThinkPHP/');
	//web地址
	define('SITE_URL','http://wx.lolwen.tk/');
	//调试模式
	define("APP_DEBUG",TRUE);
	//定义项目名称和路径
	define('APP_NAME'	, 'main');
	define('APP_PATH'	, SITE_PATH.APP_NAME . '/');
	// 加载框架入口文件
	require(THINK_PATH."/ThinkPHP.php");
?>
