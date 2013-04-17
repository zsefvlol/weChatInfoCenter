<?php
class CommonModel extends Model {

	protected function _hashUserNameToInt($userName){
		return substr(crc32($userName),-1);
	}
	
}
?>