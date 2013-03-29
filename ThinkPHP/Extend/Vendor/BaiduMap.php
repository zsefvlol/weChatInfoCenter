<?php
class BaiduMap{
	
	public static function getNearby($lat,$lng,$keyWord,$count = 3){
		$url = 'http://api.map.baidu.com/geocoder?output=json&location='.$lat.','.$lng.'&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		$message = $apiResult['result']['formatted_address'] ? $apiResult['result']['formatted_address'] : '您';
		$message .= '附近的'.$keyWord;
		$url = 'http://api.map.baidu.com/place/search?&query='.$keyWord.'&location='.$lat.','.$lng.'&radius=1000&output=json&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		//如果1000米内没有，找2000米内
		if(!count($apiResult['results'])) {
			$url = 'http://api.map.baidu.com/place/search?&query='.$keyWord.'&location='.$lat.','.$lng.'&radius=2000&output=json&key='.C('BAIDU_MAP_API');
			$apiResult = json_decode(file_get_contents($url),true);
			if(!count($apiResult['results'])) return '附近2000米内未找到相关地点！';
		}
		vendor('IsgdShortUrl');
		foreach($apiResult['results'] as $k=>$v){
			$message .= "\n\n" . $v['name'] . "\n" . $v['address'];
			if ($v['telephone']) $message .= "\n" . $v['telephone'];
			//$message .= "\n" . IsgdShortUrl::shorten($v['detail_url']);
			$message .= "\n" . $v['detail_url'];
			if(--$count<=0) break;
		}
		return $message;
	}
	
	public static function getCityByLocation($lat,$lng){
		$url = 'http://api.map.baidu.com/geocoder?output=json&location='.$lat.','.$lng.'&key='.C('BAIDU_MAP_API');
		$apiResult = json_decode(file_get_contents($url),true);
		return $apiResult['result']['addressComponent']['city'] ? $apiResult['result']['addressComponent']['city'] : false;
	}
	
}