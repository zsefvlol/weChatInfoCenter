<?php
return array(
	/*db seting*/
    'URL_MODEL'         =>  3, // 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'           =>  'mysql',
	'DB_HOST'           =>  'localhost',
	'DB_NAME'           =>  'db_wechat_info_center',
	'DB_USER'           =>  'wxinfocenter',
	'DB_PWD'            =>  'wxinfocenter!',
	'DB_PORT'           =>  '3306',
	'DB_PREFIX'         =>  'tb_',
    'DB_CHARSET'	    =>	'utf8',

	'APP_AUTOLOAD_PATH'=>'ORG.Util',

	'WX_TOKEN'			=>	'hvVjiNmw2NKt3DhJ',
	
	'WX_DEFAULT_CONTENT'=>	"欢迎使用信息查询系统，本系统正在建设中。有问题联系zsefvlol@163.com\n目前支持：:\n天气：天气 北京",
		
	'BAIDU_MAP_API'		=>	'4d25a7442c6136e1a6c8d28ef2626a71',	
);
?>