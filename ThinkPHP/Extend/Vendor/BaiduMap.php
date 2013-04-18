<?php
class BaiduMap{
	
	public static function getNearby($lat,$lng,$keyWord,$count = 5){
		$url = 'http://api.map.baidu.com/geocoder?output=json&location='.$lat.','.$lng.'&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		$title = $apiResult['result']['formatted_address'] ? $apiResult['result']['formatted_address'] : '您';
		$title .= '附近的'.$keyWord;
		$url = 'http://api.map.baidu.com/place/search?&query='.$keyWord.'&location='.$lat.','.$lng.'&radius=1000&output=json&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		//如果1000米内没有，找2000米内
		if(!count($apiResult['results'])) {
			$url = 'http://api.map.baidu.com/place/search?&query='.$keyWord.'&location='.$lat.','.$lng.'&radius=2000&output=json&key='.C('BAIDU_MAP_API');
			$apiResult = json_decode(file_get_contents($url),true);
			if(!count($apiResult['results'])) return '附近2000米内未找到相关地点！';
		}
		$result = array('title'=>$title,'places'=>array());
		
		foreach($apiResult['results'] as $k=>$v){
			array_push($result['places'], array(
				'name'		=>	$v['name'],
				'address'	=>	$v['address'],
				'telephone'	=>	$v['telephone'] ? $v['telephone'] : '',
				'url'		=>	str_replace('http://api.map.baidu.com/place/detail?', 'http://map.baidu.com/mobile/#place/detail/qt=inf&', $v['detail_url'])
			));
			if(--$count<=0) break;
		}
		return $result;
	}
	
	public static function getCityByLocation($lat,$lng){
		$url = 'http://api.map.baidu.com/geocoder?output=json&location='.$lat.','.$lng.'&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		return $apiResult['result']['addressComponent']['city'] ? $apiResult['result']['addressComponent']['city'] : false;
	}
	
}