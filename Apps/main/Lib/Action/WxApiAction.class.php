<?php
class WxApiAction extends CommonAction
{

	public function api(){
		//验证Token
		$this->verifyToken();
		//网站接入验证
		if(isset($_GET['echostr'])) exit($_GET['echostr']);
	}
	
	/**
	 * 验证token
	 * @return bool
	 */
	private function verifyToken() {
		$token = '';
		$signature = addslashes(htmlspecialchars($_GET('signature')));
		$timestamp = addslashes(htmlspecialchars($_GET('timestamp')));
		$nonce = addslashes(htmlspecialchars($_GET('nonce')));
		$tmpArr = array(C('WX_TOKEN'), $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature) return true;
	}
}
?>