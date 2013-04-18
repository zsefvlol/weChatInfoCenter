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
	
	'WX_DEFAULT_CONTENT'=>	"欢迎使用信息查询系统，本系统正在建设中。有问题联系zsefvlol@163.com\n查天气输入：\n天气 北京\n天气\n查周边输入：\n附近 银行\n查百科输入：\n百科 香槟\n查新闻输入：\n新闻\n国内新闻\n国际新闻",
		
	'BAIDU_MAP_API'		=>	'4d25a7442c6136e1a6c8d28ef2626a71',	
);
?>