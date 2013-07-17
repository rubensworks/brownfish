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
}
?>