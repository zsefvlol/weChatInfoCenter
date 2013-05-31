<?php
class YoudaoTranslate{
	public static function translate($keyWord){
		$url = 'http://fanyi.youdao.com/openapi.do?keyfrom=weChatInfoCenter&key=594387319&type=data&doctype=json&version=1.1&q=' . $keyWord;
		$result = json_decode(file_get_contents($url),true);
		$info = array(
				array($keyWord,'',SITE_URL.'background.png'),
				array(implode($result['translation'],"\n"))
		);
		if ($result['basic']) {
			$basicInfo = "基本释义";
			if ($result['basic']['phonetic'])
				$basicInfo .= "\n拼音：" . $result['basic']['phonetic'];
			if ($result['basic']['explains'])
				$basicInfo .= "\n翻译：\n" . implode("\n", $result['basic']['explains']);
			array_push($info, array($basicInfo));
		}
		if ($result['web']) {
			$webInfo = "网络释义";
			foreach ($result['web'] as $k=>$v){
				$webInfo .= "\n【" . $v['key'] ."】" .implode(';', $v['value']);
			}
			array_push($info, array($webInfo));
		}
		return $info;
	}

}
