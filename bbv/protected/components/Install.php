<?php
/**
 * This allows the full installation into the database.
 * @author Ruben Taelman
 *
 */
class Install {
	
	/**
	 * The config keys that are required for writing into the config.php file with writeConfig($data)
	 * @var array array of config keys
	 */
	public static $CONFIG_KEYS = array(
			'DB_HOST',
			'DB_NAME',
			'DB_USERNAME',
			'DB_PASSWORD',
	);
	
	/**
	 * Convert a data array to a config file
	 */
	public static function writeConfig($data) {
		$fileLocation = YiiBase::getPathOfAlias('application.config')."/config.php";
		$content = "<?php\ndefine('INSTALLED', true);\n";
		foreach($data as $key=>$value) {
			$content .= "\ndefine('$key', '$value');";
		}
		$ret = file_put_contents($fileLocation, $content);
		chmod($fileLocation, 0666);
		return $ret;
	}
	
	/**
	 * Execute the required sql scripts to make the required tables
	 */
	public static function buildDatabase() {
		// Lookup the schema and data files
		$schemaLocation = YiiBase::getPathOfAlias('application.data')."/schema.mysql.sql";
		$dataLocation = YiiBase::getPathOfAlias('application.data')."/data.mysql.sql";
		
		// Make the commands
		$connection=Yii::app()->db;
		$schemaCommand=$connection->createCommand(file_get_contents($schemaLocation));
		$dataCommand=$connection->createCommand(file_get_contents($dataLocation));
		
		// Execute the files
		$schemaCommand->execute();
		$dataCommand->execute();
	}
	
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
		Config::setValue(Config::$KEYS['FILE_ALLOWED_TYPES'], array(
			'image/gif',
			'image/jpeg',
			'image/png',
			'application/pdf',
			'application/x-pdf',
		));
	}
	
	/**
	 * Make the config file, create the database tables and save all the basic settings into the database
	 */
	public static function install() {
		/*Install::writeConfig(array('IETS'=>'WAT'));  // TODO: fill in the params
		self::buildDatabase();
		self::makeIndexPage();
		self::makeDefaultCategory();
		self::setPreferences();*/
		// Commented out for debugging safety
	}
}
?>