<?php
class IndexAction extends CommonAction
{
	public function index(){
		vendor('phpQuery');
		$url = 'http://baike.baidu.com/search/word?word=北京&pic=1&sug=1&enc=utf8';
		$html = file_get_contents($url);
		var_dump($html);
		phpQuery::newDocumentHTML($html);
		$title = pq('h1.title')->html();
		$summary = strip_tags(pq('.card-summary-content')->html());
		$img = pq('img.card-image')->attr('src');
		$header = get_headers($url);
		foreach ($header as $k=>$v)
			if (strpos( $v , 'Location:')!==false)
			$baikeUrl = 'http://baike.baidu.com'.trim(str_replace('Location:', '', $v));
		var_dump( array(
				'title'=>$title,
				'summary'=>$summary,
				'img'=>$img,
				'baikeUrl'=>$baikeUrl));
		};
	}

}
?>