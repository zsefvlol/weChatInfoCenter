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
		$title = str_replace('百科首页 >', '', strip_tags(htmlspecialchars_decode(pq('div.crumbs')->html())));
		$summary = preg_replace('/[\t\s\r\n]+/', ' ', str_replace('百科名片','',htmlspecialchars_decode(strip_tags(pq('.card')->contents()))));
		if (!$summary) $summary = htmlspecialchars_decode(strip_tags(pq('.content')->html()));
		$img = str_replace('quality=60&size=w160', 'quality=100&size=w320', pq('.img-box img')->attr('src'));
		return $title ? array(
				'title'=>trim($title),
				'summary'=>trim($summary),
				'img'=>$img,
				'baikeUrl'=>$baikeUrl) : false;
	}
}
