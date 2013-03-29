<?php
class WxApiAction extends CommonAction
{

	public function api(){
		//验证Token
		//if(!$this->verifyToken()) exit('Token Verification Failed.');
		//网站接入验证
		if(isset($_GET['echostr'])) exit($_GET['echostr']);
		//处理
		$result = $this->handleUserRequest();
		$response = $this->getXmlResult($result);
		D('ResponseLog')->saveResponseLog($result,$response);
		exit();
	}
	
	private function handleUserRequest(){
		$str_post = empty($GLOBALS['HTTP_RAW_POST_DATA']) ? file_get_contents('php://input') : $GLOBALS['HTTP_RAW_POST_DATA'];
		if (!empty($str_post)) {
			$request = $this->obj2array(simplexml_load_string($str_post, 'SimpleXMLElement', LIBXML_NOCDATA));
			D('RawLog')->saveRawLog($request);
			switch($request['MsgType']){
				case 'text':
					$result = $this->handleTextMessage($request);
					break;
				case 'location':
					$result = $this->handleLocationMessage($request);
					break;
			}
		} else {
			$result['msgType'] = 'text';
			$result['arrContent'] = array(C('WX_DEFAULT_CONTENT'));
		}
		return $result;
	}
	
	private function handleTextMessage($message){
		$result  = array(
				'msgType'		=>	'text',
				'toUsername'	=>	$message['FromUserName'],
				'fromUsername'	=>	$message['ToUserName'],
				'arrContent'	=>	array(json_encode($message))
		);
		return $result;
	}
	
	private function handleLocationMessage($message){
		$result  = array(
				'msgType'		=>	'text',
				'toUsername'	=>	$message['FromUserName'],
				'fromUsername'	=>	$message['ToUserName'],
				'arrContent'	=>	array(json_encode($message))
		);
		return $result;
	}

	/**
	 * 获得xml模板结构
	 * @input array(
	 * 			'msgType'=>'text',
	 * 			'toUsername'=>'xxx',
	 * 			'fromUserName'=>'xxx',
	 * 			'arrContent'=>array());
	 * @return String - $xmlResult
	 */
	private function getXmlResult($result) {
		$msgType = $result['msgType'];
		$toUsername = $result['toUsername'];
		$fromUsername = $result['fromUsername'];
		$arrContent = $result['arrContent'];
		if (empty($msgType)) {
			return false;
		}
		$xmlResult = '<xml>';
		$xmlResult .= '<ToUserName><![CDATA[' . $toUsername . ']]></ToUserName>'; //接收方帐号（收到的OpenID）
		$xmlResult .= '<FromUserName><![CDATA[' . $fromUsername . ']]></FromUserName>'; //开发者微信号
		$xmlResult .= '<CreateTime>' . time() . '</CreateTime>'; //消息创建时间
		$xmlResult .= '<MsgType><![CDATA[' . $msgType . ']]></MsgType>'; //text,music,news
		switch ($msgType) {
			case 'text' :
				$value = isset($arrContent[0]) ? $arrContent[0] : "";
				$xmlResult .= '<Content><![CDATA[' . $value . ']]></Content>'; //回复的消息内容
				$xmlResult .= '<FuncFlag>0</FuncFlag>';
				break;
	
			case 'music' :
				$value = isset($arrContent[0]) ? $arrContent[0] : array();
	
				$xmlResult .= '<Music>';
				$xmlResult .= '<Title><![CDATA[' . $value[0] . ']]></Title>'; //音乐标题
				$xmlResult .= '<Description><![CDATA[' . $value[1] . ']]></Description>'; //音乐描述
				$xmlResult .= '<MusicUrl><![CDATA[' . $value[2] . ']]></MusicUrl>'; //音乐链接
				$xmlResult .= '<HQMusicUrl><![CDATA[' . $value[3] . ']]></HQMusicUrl>'; //高质量音乐链接，WIFI环境优先使用该链接播放音乐
				$xmlResult .= '</Music>';
				$xmlResult .= '<FuncFlag>0</FuncFlag>';
				break;
	
			case 'news' :
				$xmlResult .= '<ArticleCount>' . count($arrContent) . '</ArticleCount>';
				foreach ($arrContent as $value) {
					$xmlResult .= '<Articles>';
					$xmlResult .= '<item>';
					$xmlResult .= '<Title><![CDATA[' . $value[0] . ']]></Title>';
					$xmlResult .= '<Description><![CDATA[' . $value[1] . ']]></Description>';
					$xmlResult .= '<PicUrl><![CDATA[' . $value[2] . ']]></PicUrl>';
					$xmlResult .= '<Url><![CDATA[' . $value[3] . ']]></Url>';
					$xmlResult .= '</item>';
					$xmlResult .= '</Articles>';
				}
				$xmlResult .= '<FuncFlag>1</FuncFlag>';
				break;
			default :
				break;
		}
		$xmlResult .= '</xml>';
	
		return $xmlResult;
	}
	
	
	/**
	 * 验证token
	 * @return bool
	 */
	private function verifyToken() {
		$token = '';
		$signature = addslashes(htmlspecialchars($_GET['signature']));
		$timestamp = addslashes(htmlspecialchars($_GET['timestamp']));
		$nonce = addslashes(htmlspecialchars($_GET['nonce']));
		$tmpArr = array(C('WX_TOKEN'), $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature) return true;
	}
}
?>