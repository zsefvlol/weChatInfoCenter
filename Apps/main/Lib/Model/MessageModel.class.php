<?php
class MessageModel extends CommonModel {

	public function saveMessage($message,$funcType,$keyWord){
		$message['rawData'] = json_encode($message);
		$message['funcType'] = $funcType;
		$message['keyWord'] = $keyWord;
		$this->getMessageModel($message['FromUserName'])->add($message);
	}
	
	public function getLastMessage($message){
		return $this->getMessageModel($message['FromUserName'])->order('msgId desc')->find();
	}
	
	private function getMessageModel($openSnsId){
		return D('Message_' . substr(crc32($openSnsId),-1));
	}
}
?>