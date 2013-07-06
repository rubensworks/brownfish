<?php
/**
 * Common utilities
 * @author Ruben Taelman
 *
 */
class Utils {
	
	public static $CACHE_NEWS_CONTENT = "news_content";
	public static $CACHE_COMMENTS = "news_comments";
	public static $CACHE_NAVIGATION = "navigation";
	
	public static $CACHE_DURATION_VERY_SHORT = 10;
	public static $CACHE_DURATION_SHORT = 3600;
	public static $CACHE_DURATION_LONG = 86400;
		
	/**
	 * Creates a display date for the given timestamp
	 * @param integer $timestamp unix timestamp
	 * @param boolean $extended if the date should included h,m,s
	 * @return date
	 */
	public static function displayDate($timestamp, $extended=false) {
		return date("d-m-Y".($extended?" H:m:s":""), $timestamp);
	}
	
	/**
	 * Limits the length of a string and ads \ldots if the size was too large
	 * @param string $value string to be shortened
	 * @param int $length max length of the string
	 * @return string posibly shortened string
	 */
	public static function limitLength($value, $length) {
		return strlen($value)<$length?$value:substr($value, 0, $length-3)."...";
	}
	
	/**
	 * Return all the available Item types in the application
	 * @return multitype:string list of Item types
	 */
	public static function getItemTypes() {
		return array(
				"DummyItem",
				"NewsItem",
				"TextItem",
		);
	}
}
?>