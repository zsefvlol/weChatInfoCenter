<?php
class Weather{
	
	static private $tree;
	static private $path;
	static private $index;
	static private $file_path;
	static private $inited = false;
	
	public static function getWeather($placeName){
		$arrReplace = array(
				"/中国/i",
				"/(([回|满|藏|壮|彝|傣|蒙古|朝鲜]族)自治(州|县)|省|市|区|地区|区县).*/i",
		);
		$placeName = preg_replace($arrReplace, "", $placeName);
		$code = self::search($placeName,'station');
		if( $code !== false ){
			$weather = file_get_contents( 'http://m.weather.com.cn/data/'.$code.'.html' );
			$weather = json_decode( $weather, true );
			$weather = $weather['weatherinfo'];
			
// 			$message = $weather['city'] . ' ' . date('d日') .' '. $weather['week'] . "\n"
// 					. $weather['weather1'] . ' ' . $weather['temp1'] . ' ' . $weather['wind1']
// 					. "\n明天：" . $weather['weather2'] . ' ' . $weather['wind2'] . ' ' . $weather['temp2']
// 					. "\n" . $weather['index_d'];
			$message = array(
					array($weather['city'] . date(' m月d日 ') . $weather['week']),
					array('今天：'. $weather['weather1'] . ' ' . $weather['temp1'] . ' ' . $weather['wind1']),
					array('明天：'. $weather['weather2'] . ' ' . $weather['temp2'] . ' ' . $weather['wind2']),
					array($weather['index_d'])
					);
		}else{
			$city = self::searchTree( $placeName, 'city' );
			if( $city ){
				$temp = array();
				foreach( $city as $itme ){
					$temp[] = $itme['value'];
				}
				$message = '您所输入的城市包容以下区域：' . implode( ', ', $temp ) . '，请重新查询。';
			}else{
				$province = self::searchTree( $placeName, 'province' );
				if( $province ){
					$temp = array();
					foreach( $province as $itme ){
						$temp[] = $itme['value'];
					}
					$message = '您所输入的省或自治区包容以下城市：' . implode( ', ', $temp ) . '，请重新查询。';
				}
			}
		}
		if(!$message) $message = '未找到您所输入的地区，仅支持中国。';
		return $message;
	}
	
	public static function search( $val, $type ){
		self::initCity();
		if( !$val || !$type ) return false;
		$key = array_search( $val, self::$index[$type] );
		return $key;
	}

	private static function searchTree( $val, $type ){
		self::initCity();
		$key = self::search( $val, $type );
		if( $key !== false ){
			$path = self::$path[$key];
			$tree = self::$tree;
			while( $tmp = array_shift( $path ) ){
				if( $tree[$tmp]['child'] )
					$tree = $tree[$tmp]['child'];
			}
		}
		return $tree;
	}
	

	private static function initCity(){
		if( self::$inited ) return;
	
		self::$tree  = array();
		self::$index = array();
		self::$path  = array();
	
		self::$file_path = dirname( __FILE__ );
	
		$file_tree  = self::$file_path.'/city_tree.txt';
		$file_path  = self::$file_path.'/city_path.txt';
		$file_index = self::$file_path.'/city_index.txt';
	
		self::$tree = file_get_contents( $file_tree );
		self::$tree = unserialize( self::$tree );
		self::$path = file_get_contents( $file_path );
		self::$path = unserialize( self::$path );
		self::$index = file_get_contents( $file_index );
		self::$index = unserialize( self::$index );
	
		self::$inited = true;
	}
}