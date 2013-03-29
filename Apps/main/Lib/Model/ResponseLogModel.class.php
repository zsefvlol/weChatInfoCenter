<?php
class ResponseLogModel extends CommonModel {

	public function saveResponseLog($request,$response){
		$arr = array(
				'fromUserName'	=>	$request['fromUsername'] ? $request['fromUsername'] : '',
				'toUserName'	=>	$request['toUsername'] ? $request['toUsername'] : '',
				'createTime'	=>	$request['createTime'] ? $request['createTime'] : time(),
				'msgType'		=>	$request['msgType'] ? $request['msgType'] : '',
				'msgId'			=>	$request['msgId'] ? $request['msgId'] : '',
				'responseData'		=>	$response,
				);
		$this->add($arr);
	}
}
?>