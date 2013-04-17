<?php
class BaiduBaike{
	public static function getSummary($keyWord){
		vendor('phpQuery');
		$url = 'http://baike.baidu.com/search/word?word='.$keyWord.'&pic=1&sug=1&enc=utf8';
		$header = get_headers($url);
		foreach ($header as $k=>$v)
			if (strpos( $v , 'Location:')!==false)
			$baikeUrl = 'http://baike.baidu.com'.trim(str_replace('Location:', '', $v));
		$html = file_get_contents($baikeUrl);
		phpQuery::newDocumentHTML($html);
		$title = pq('h1.title')->html();
		$summary = strip_tags(pq('.card-summary-content')->html());
		if (!$summary) $summary = pq('div.para')->get(0)->textContent;
		$img = pq('img.card-image')->attr('src');
		return $title ? array(
				'title'=>$title,
				'summary'=>$summary,
				'img'=>$img,
				'baikeUrl'=>$baikeUrl) : false;
	}
}
