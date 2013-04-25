<?php
class DoubanHotMovie{
	public static function getHotMovie($count = 10){
		vendor('phpQuery');
		$html = file_get_contents('http://movie.douban.com');
		phpQuery::newDocumentHTML($html);
		$movies = pq('.ui-slide-item');
		$info = array();
		while ($movies){
			$text = $movies->attr('data-title');
			$text .= "\n评分：" . $movies->attr('data-rate');
			$text .= "\n地区：" . $movies->attr('data-region');
			$text .= "\n导演：" . $movies->attr('data-director');
			$text .= "\n主演：" . $movies->attr('data-actors');
			$pic = $movies->find('img')->attr('data-original');
			if (!$pic) $pic = $movies->find('img')->attr('src');
			$info[] =array(
					'title'	=>	$text,
					'pic'	=>	$pic,
					'url'	=>	$movies->find('a')->attr('href'),
					);
			$movies = $movies->next();
			if (!--$count) break;
		}
		return $info;
	}
	
}