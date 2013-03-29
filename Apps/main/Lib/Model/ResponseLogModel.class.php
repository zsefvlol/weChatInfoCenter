<?php
class ResponseLogModel extends CommonModel {

	public function saveResponseLog($request,$response){
		$arr = array(
				'fromUserName'	=>	$request['FromUserName'] ? $request['FromUserName'] : '',
				'toUserName'	=>	$request['ToUserName'] ? $request['ToUserName'] : '',
				'createTime'	=>	$request['CreateTime'] ? $request['CreateTime'] : '',
				'msgType'		=>	$request['MsgType'] ? $request['MsgType'] : '',
				'msgId'			=>	$request['MsgId'] ? $request['MsgId'] : '',
				'responseData'		=>	$response,
				);
		$this->add($arr);
	}
}
?>