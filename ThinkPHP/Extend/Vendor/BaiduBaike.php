<?php
class BaiduBaike{
	public static function getSummary($keyWord){
		vendor('phpQuery');
		$url = 'http://baike.baidu.com/search/word?word='.urlencode($keyWord).'&pic=1&sug=1&enc=utf8';
		$header = get_headers($url);
		foreach ($header as $k=>$v)
			if (strpos( $v , 'Location:')!==false)
			$baikeUrl = 'http://wapbaike.baidu.com'.trim(str_replace('Location:', '', $v));
		$html = file_get_contents($baikeUrl);
		phpQuery::newDocumentHTML($html);
		$title = htmlspecialchars_decode(pq('h1.title:first')->html());
		$summary = htmlspecialchars_decode(strip_tags(pq('.summary:first')->html()));
		if (!$summary) $summary = htmlspecialchars_decode(strip_tags(pq('content:first')->html()));
		$img = pq('img-box img:first')->attr('src');
		//if (!$img) $img = pq('img.editorImg:first')->attr('data-src');
		return $title ? array(
				'title'=>trim($title),
				'summary'=>trim($summary),
				'img'=>$img,
				'baikeUrl'=>$baikeUrl) : false;
	}
}
