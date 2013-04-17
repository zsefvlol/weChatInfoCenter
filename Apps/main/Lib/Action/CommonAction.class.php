<?php
class CommonAction extends Action {
	
	public static function obj2array($obj) {
		$_array = is_object ( $obj ) ? get_object_vars ( $obj ) : $obj;
		foreach ( $_array as $key => $value ) {
			$value = (is_array ( $value ) || is_object ( $value )) ? self::obj2array ( $value ) : $value;
			$array [$key] = $value;
		}
		return $array;
	}

	
} //class end

?>