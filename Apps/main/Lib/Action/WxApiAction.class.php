<?php
class WxApiAction extends CommonAction
{

	private static $FUNC_TYPE_WEATHER = 1;
	private static $FUNC_TYPE_NEARBY = 2;
	private static $FUNC_TYPE_BAIKE = 3;
	private static $FUNC_TYPE_NEWS = 4;
	
	public function api(){
		//验证Token
		if(!$this->verifyToken()) exit('Token Verification Failed.');
		//网站接入验证
		if(isset($_GET['echostr'])) exit($_GET['echostr']);
		//处理
		$result = $this->handleUserRequest();
		$response = $this->getXmlResult($result);
		D('ResponseLog')->saveResponseLog($result,$response);
		echo $response;
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
				case 'event':
					$result = $this->handleEventMessage($request);
					break;
			}
		} else {
			$result['msgType'] = 'text';
			$result['arrContent'] = array(C('WX_DEFAULT_CONTENT'));
		}
		return $result;
	}
	
	/**
	 * 处理文本信息
	 * @param array $message
	 * @return multitype:string unknown multitype:string
	 */
	private function handleTextMessage($message){
		$content = explode(' ', preg_replace('/\s+/', ' ', trim($message['Content'])));
		$UserInfo = D('UserInfo');
		$messageType = 'text';
		switch ($content[0]){
			case '天气' : 
				$UserInfo->setUserInfo($message['FromUserName'],'lastLocationFuncType',self::$FUNC_TYPE_WEATHER);
				if($content[1])	{
					$messageType = 'news';
					$UserInfo->setUserInfo($message['FromUserName'],'lastWeatherCity',$content[1]);
					D('Message')->saveMessage($message,self::$FUNC_TYPE_WEATHER,$content[1]);
					vendor('Weather');
					$info = Weather::getWeather($content[1]);
				}
				else {
					$lastCity = $UserInfo->getUserInfo($message['FromUserName'],'lastWeatherCity');
					if ($lastCity) {
						D('Message')->saveMessage($message,self::$FUNC_TYPE_WEATHER,$lastCity);
						$messageType = 'news';
						vendor('Weather');
						$info = Weather::getWeather($lastCity);
						$info[] = array("查询其他地区天气，点下方小加号，选择“位置”，或发送：天气 北京");
					}
					else{
						D('Message')->saveMessage($message,self::$FUNC_TYPE_WEATHER,'');
						$info = "请发送地理位置信息\n点下方小加号，选择“位置”";
					}
				}
			break;
			case '附近' :
				$UserInfo->setUserInfo($message['FromUserName'],'lastLocationFuncType',self::$FUNC_TYPE_NEARBY);
				if(!$content[1]) $info = "请输入商户类型\n如：附近 银行";
				else{
					$UserInfo->setUserInfo($message['FromUserName'],'lastKeyWord',$content[1]);
					D('Message')->saveMessage($message,self::$FUNC_TYPE_NEARBY,$content[1]);
					$info = "请发送地理位置信息\n点下方小加号，选择“位置”\n如果发送后没有回应，请再发一次位置信息";
				}
				break;
			case '百科' :
				if (!$content['1']) $info = "请输入查询的内容\n如：百科 香槟";
				else{
					vendor('BaiduBaike');
					if (count($content)>2){
						array_shift($content);
						$keyWord = implode(' ', $content);
					}
					else $keyWord = $content[1]; 
					D('Message')->saveMessage($message,self::$FUNC_TYPE_BAIKE,$keyWord);
					$result = BaiduBaike::getSummary($keyWord);
					if (!$result) $info = "未查到该内容的百科\n请尝试其他关键词";
					else{
						$messageType = 'news';
						$info = array(array(
								$result['title'],
								$result['summary'],
								$result['img'],
								$result['baikeUrl']
								));
					}
				}
				break;
			case '国内新闻':
			case '新闻':
				vendor('BaiduNews');
				D('Message')->saveMessage($message,self::$FUNC_TYPE_NEWS,'国内');
				$news = BaiduNews::getCivilNews();
				$messageType = 'news';
				foreach ($news as $k=>$v)
					$info[] = array($v['content'],'',$v['pic'],$v['url']);
				break;
			case '国际新闻':
				vendor('BaiduNews');
				D('Message')->saveMessage($message,self::$FUNC_TYPE_NEWS,'国际');
				$news = BaiduNews::getInterNews();
				$messageType = 'news';
				foreach ($news as $k=>$v)
					$info[] = array($v['content'],'',$v['pic'],$v['url']);
				break;
			default :
				$info = C('WX_DEFAULT_CONTENT');
			break;
		}
		$result  = array(
				'msgType'		=>	$messageType,
				'toUsername'	=>	$message['FromUserName'],
				'fromUsername'	=>	$message['ToUserName'],
				'msgId'			=>	$message['MsgId'],
				'arrContent'	=>	$info
		);
		return $result;
	}
		
	/**
	 * 处理位置信息
	 * @param array $message
	 * @return multitype:string unknown multitype:string
	 */
	private function handleLocationMessage($message){
		$UserInfo = D('UserInfo');
		$lastFunc = $UserInfo->getUserInfo($message['FromUserName'],'lastLocationFuncType');
		$messageType = 'text';
		switch ($lastFunc){
			case self::$FUNC_TYPE_NEARBY :
				$lastKeyWord = $UserInfo->getUserInfo($message['FromUserName'],'lastKeyWord');
				vendor('BaiduMap');
				$places = BaiduMap::getNearby($message['Location_X'], $message['Location_Y'], $lastKeyWord);
				$UserInfo->setUserInfo($message['FromUserName'],'lastLocation',json_encode(array(
						'Location_X'=>$message['Location_X'], 'Location_Y'=>$message['Location_Y']
				)));
				if (is_array($places)){
					$messageType = 'news';
					$info[] = array($places['title']);
					foreach ($places['places'] as $k=>$v){
						if ($v['telephone']) $v['address'] .= "\n电话：" . $v['telephone'];
						$info[] = array($v['name']."\n".$v['address'],'','',$v['url']);
					}
				}
				else{
					$info = $places;
				}
				break;
			case self::$FUNC_TYPE_WEATHER :
				vendor('BaiduMap');
				vendor('Weather');
				$city = BaiduMap::getCityByLocation($message['Location_X'], $message['Location_Y']);
				if (!$city) $info = '未找到您所在的城市';
				else {
					$info = Weather::getWeather($city);
					if (is_array($info)){
						$messageType = 'news';
						$UserInfo->setUserInfo($message['FromUserName'],'lastWeatherCity',$city);
					}
				}
				break;
			default:
				$info = C('WX_DEFAULT_CONTENT');
		}
		$result  = array(
				'msgType'		=>	$messageType,
				'toUsername'	=>	$message['FromUserName'],
				'fromUsername'	=>	$message['ToUserName'],
				'msgId'			=>	$message['MsgId'],
				'arrContent'	=>	$info
		);
		return $result;
	}

	/**
	 * 处理Event事件
	 * @param array $message
	 * @return multitype:string unknown multitype:Ambigous <mixed, void, NULL, multitype:>
	 */
	private function handleEventMessage($message){
		$result  = array(
				'msgType'		=>	'text',
				'toUsername'	=>	$message['FromUserName'],
				'fromUsername'	=>	$message['ToUserName'],
				'msgId'			=>	$message['MsgId'],
				'arrContent'	=>	array(C('WX_DEFAULT_CONTENT'))
		);
		return $result;
	}	

	/**
	 * 输出xml结果
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
				$xmlResult .= '<Content><![CDATA[' . $arrContent . ']]></Content>'; //回复的消息内容
				$xmlResult .= '<FuncFlag>0</FuncFlag>';
				break;
	
			case 'music' :
				$xmlResult .= '<Music>';
				$xmlResult .= '<Title><![CDATA[' . $arrContent[0] . ']]></Title>'; //音乐标题
				$xmlResult .= '<Description><![CDATA[' . $arrContent[1] . ']]></Description>'; //音乐描述
				$xmlResult .= '<MusicUrl><![CDATA[' . $arrContent[2] . ']]></MusicUrl>'; //音乐链接
				$xmlResult .= '<HQMusicUrl><![CDATA[' . $arrContent[3] . ']]></HQMusicUrl>'; //高质量音乐链接，WIFI环境优先使用该链接播放音乐
				$xmlResult .= '</Music>';
				$xmlResult .= '<FuncFlag>0</FuncFlag>';
				break;
	
			case 'news' :
				$xmlResult .= '<ArticleCount>' . count($arrContent) . '</ArticleCount>';
				$xmlResult .= '<Articles>';
				foreach ($arrContent as $key=>$value) {
					$xmlResult .= '<item>';
					$xmlResult .= '<Title><![CDATA[' . $value[0] . ']]></Title>';
					$xmlResult .= '<Description><![CDATA[' . $value[1] . ']]></Description>';
					$xmlResult .= '<PicUrl><![CDATA[' . $value[2] . ']]></PicUrl>';
					$xmlResult .= '<Url><![CDATA[' . $value[3] . ']]></Url>';
					$xmlResult .= '</item>';
				}
				$xmlResult .= '</Articles>';
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