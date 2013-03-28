<?php
class RawLogModel extends CommonModel {

	public function saveRawLog($request){
		$arr = array(
				'fromUserName'	=>	$request->FromUserName,
				'toUserName'	=>	$request->ToUserName,
				'createTime'	=>	$request->CreateTime,
				'msgType'		=>	$request->MsgType,
				'msgId'			=>	$request->MsgId,
				'rawData'		=>	json_encode(CommonAction::obj2array($request)),
				);
		$this->add($arr);
	}
}
?>