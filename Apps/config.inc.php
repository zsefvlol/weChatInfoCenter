<?php
return array(
	/*db seting*/
    'URL_MODEL'         =>  3, // 如果你的环境不支持PATHINFO 请设置为3
	'DB_TYPE'           =>  'mysql',
	'DB_HOST'           =>  'localhost',
	'DB_NAME'           =>  'DB_WECHAT_INFO_CENTER',
	'DB_USER'           =>  'wxinfocenter',
	'DB_PWD'            =>  'wxinfocenter!',
	'DB_PORT'           =>  '3306',
	'DB_PREFIX'         =>  'tb_',
    'DB_CHARSET'	    =>	'utf8',

	'APP_AUTOLOAD_PATH'=>'ORG.Util',

	'WX_TOKEN'			=>	'hvVjiNmw2NKt3DhJ',
	
	'WX_DEFAULT_CONTENT'=>	'欢迎使用信息查询系统，本系统正在建设中。有问题联系zsefvlol@163.com',
);
?>