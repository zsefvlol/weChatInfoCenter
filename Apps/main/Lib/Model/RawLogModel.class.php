<?php
class RawLogModel extends CommonModel {

	public function saveRawLog($request){
		$arr = array(
				'fromUserName'	=>	$request['FromUserName'] ? $request['FromUserName'] : '',
				'toUserName'	=>	$request['ToUserName'] ? $request['ToUserName'] : '',
				'createTime'	=>	$request['CreateTime'] ? $request['CreateTime'] : '',
				'msgType'		=>	$request['MsgType'] ? $request['MsgType'] : '',
				'msgId'			=>	$request['MsgId'] ? $request['MsgId'] : '',
				'rawData'		=>	json_encode($request),
				);
		$this->add($arr);
	}
}
?>