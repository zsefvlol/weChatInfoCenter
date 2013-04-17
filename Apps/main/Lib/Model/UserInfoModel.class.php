<?php
class UserInfoModel extends CommonModel {

	
	public function setUserInfo($userName,$ukey,$uvalue){
		$this->_getUserInfoModel($userName)->save(array(
				'userName'	=>	$userName,
				'ukey'		=>	$ukey,
				'uvalue'	=>	$uvalue
			));
	}
	
	public function getUserInfo($userName,$ukey=''){
		if ($ukey){
			$result = $this->_getUserInfoModel($userName)->where(array(
				'userName'	=>	$userName,
				'ukey'		=>	$ukey,
			))->find();
			return $result['uvalue'] ? $result['uvalue'] : false;
		}
		$result = $this->_getUserInfoModel($userName)->where(array(
				'userName'	=>	$userName,
			))->select();
		return $result;
	}
	
	private function _getUserInfoModel($userName){
		return D('UserInfo_' . $this->_hashUserNameToInt($userName));
	}
	
}
?>