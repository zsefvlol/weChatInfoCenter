<?php
class UserInfoModel extends CommonModel {

	
	public function setUserInfo($userName,$ukey,$uvalue){
		if ($this->_getUserInfoModel($userName)->where(array(
				'userName'	=>	$userName,
				'ukey'		=>	$ukey
		))->find()){
			$this->_getUserInfoModel($userName)->where(array(
				'userName'	=>	$userName,
				'ukey'		=>	$ukey,
			))->save(array(
				'uvalue'	=>	$uvalue
			));
		}
		else{
			$this->_getUserInfoModel($userName)->add(array(
					'userName'	=>	$userName,
					'ukey'		=>	$ukey,
					'uvalue'	=>	$uvalue
			));
		}
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