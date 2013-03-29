<?php
class IsgdShortUrl{
	
	public static function shorten($longUrl){
		return file_get_contents('http://is.gd/create.php?format=simple&url='.$longUrl);
	}
	
}