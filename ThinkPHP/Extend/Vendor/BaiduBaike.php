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
		$title = str_replace('百科首页 > ', '', strip_tags(htmlspecialchars_decode(pq('div.crumbs')->html())));
		$summary = htmlspecialchars_decode(strip_tags(pq('.summary')->html()));
		if (!$summary) $summary = htmlspecialchars_decode(strip_tags(pq('.content')->html()));
		$img = pq('.img-box img')->attr('src');
		//if (!$img) $img = pq('img.editorImg:first')->attr('data-src');
		return $title ? array(
				'title'=>trim($title),
				'summary'=>trim($summary),
				'img'=>$img,
				'baikeUrl'=>$baikeUrl) : false;
	}
}
