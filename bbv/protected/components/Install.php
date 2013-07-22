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
	 * Make the default category
	 */
	public static function makeDefaultCategory() {
		$category = new Category();
		$category->name = "Default Category";
		$category->save();
		Config::setValue(Config::$KEYS['DEFAULT_CATEGORY'], $category->category_id);
	}
	
	/**
	 * Set default preferences
	 */
	public static function setPreferences() {
		// File upload
		Config::setValue(Config::$KEYS['FILE_MAX_SIZE'], 10000);
		Config::setValue(Config::$KEYS['FILE_ALLOWED_TYPES'], array('image/gif','image/jpg','image/png'));
	}
}
?>