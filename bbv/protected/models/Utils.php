<?php
/**
 * Common utilities
 * @author Ruben Taelman
 *
 */
class Utils {
	/**
	 * Creates a display date for the given timestamp
	 * @param unknown $timestamp unix timestamp
	 * @return date
	 */
	public static function displayDate($timestamp) {
		return date("d-m-Y", $timestamp);
	}
}
?>