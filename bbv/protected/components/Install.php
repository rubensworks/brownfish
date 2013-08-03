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
			'TBL_PREFIX',
			'MYSQLDUMP_COMMAND',
	);
	
	/**
	 * Convert a data array to a config file
	 */
	public static function writeConfig($data) {
		$fileLocation = YiiBase::getPathOfAlias('application.config')."/config.php";
		$content = "<?php\ndefine('INSTALLED', true);\n";
		foreach($data as $key=>$value) {
			$content .= "\ndefine('".addslashes($key)."', '".addslashes($value)."');";
		}
		$ret = file_put_contents($fileLocation, $content);
		chmod($fileLocation, 0666);
		return $ret;
	}
	
	/**
	 * Create a command from a dumped file location
	 * @param string $location the location of an sql dump file
	 * @return CDbCommand to run the dump file
	 */
	protected static function createCommand($location) {
		$connection = Yii::app()->db;
		$content = file_get_contents($location);
		$content = preg_replace('/{{(.*?)}}/', $connection->tablePrefix.'\1', $content);
		$command = $connection->createCommand($content);
		return $command;
	}
	
	/**
	 * Execute the required sql scripts to make the required tables
	 */
	public static function buildDatabase() {
		// Lookup the schema and data files
		$schemaLocation = YiiBase::getPathOfAlias('application.data')."/schema.mysql.sql";
		$dataLocation = YiiBase::getPathOfAlias('application.data')."/data.mysql.sql";
		
		// Make the commands
		$schemaCommand = self::createCommand($schemaLocation);
		$dataCommand = self::createCommand($dataLocation);
		
		// Execute the commands
		$schemaCommand->execute();$schemaCommand = false;
		$dataCommand->execute();$dataCommand = false;
	}
	
	/**
	 * Make the admin account
	 * @param string $username name for the admin account
	 * @param string $password password for the admin account
	 */
	public static function makeAdmin($username, $password) {
		// Make the user
		$admin = new User('install');
		$admin->pwd = $password;
		$admin->name = $username;
		$admin->save();
		
		// Give admin right
		Yii::app()->authManager->assign('Admins', $admin->id);
		return $admin;
	}
	
	/**
	 * Make the home page with default widgets
	 * @param $admin User model for the admin user
	 */
	public static function makeIndexPage($admin) {
		$page = new Page('install');
		$page->columns = 1;
		$page->author_id = $admin->id;
		$page->name = "Home";
		$page->save();
		Config::setValue(Config::$KEYS['INDEX_PAGE'], $page->id);
		
		// TODO: Add default widgets & stuff
	}
	
	/**
	 * Make a stub navigation bar with a few obvious links
	 */
	public static function makeStubNavigation() {
		// TODO
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
	 * Tests the database connection before allowing saving
	 * @param string $DB_HOST database host
	 * @param string $DB_USERNAME database username
	 * @param string $DB_PASSWORD database password
	 * @param string $DB_NAME database name
	 * @return true if the connection tested succesfully
	 */
	public static function testConnection($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME)
	{
		$connection = @mysqli_connect($DB_HOST,$DB_USERNAME,$DB_PASSWORD,$DB_NAME);
		return !mysqli_connect_errno($connection);
	}
	
	/**
	 * Make the config file, create the database tables and save all the basic settings into the database
	 * @param $config map of key=>values to save in the config file
	 * @param $username username for the admin account
	 * @param $password password for the admin account
	 */
	public static function completeInstall($config, $username, $password) {
		self::writeConfig($config);
		self::buildDatabase();
		$admin = self::makeAdmin($username, $password);
		self::makeIndexPage($admin);
		self::makeStubNavigation();
		self::makeDefaultCategory();
		self::setPreferences();
	}
}
?>