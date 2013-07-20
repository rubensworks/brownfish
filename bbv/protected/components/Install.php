<?php
/**
 * This allows the full installation into the database.
 * @author Ruben Taelman
 *
 */
class Install {
	
	/**
	 * Make the home page with default widgets
	 */
	public static function makeIndexPage() {
		$page = new Page();
		$page->columns = 1;
		$page->name = "Home";
		$page->save();
		Config::setValue(Config::$KEYS['INDEX_PAGE'], $page->id);
		
		// TODO: Add default widgets & stuff
	}
	
	/**
	 * Set default preferences
	 */
	public static function setPreferences() {
		// File upload
		Config::setValue(Config::$KEYS['FILE_MAX_SIZE'], 10000);
		Config::setValue(Config::$KEYS['FILE_ALLOWED_TYPES'], 'jpg, png, gif');
	}
}
?>