<?php

// Require the credentials file
//define('CREDENTIALS_PATH', dirname(__FILE__) . "/../config/config.php");
//require_once(CREDENTIALS_PATH);
/**
 * A command to execute database manipulation.
 * @author Ruben Taelman
 *
 */
class DatabaseCommand extends CConsoleCommand
{
	
	/**
	 * Run the mysqldump command with the given options and dump location
	 * @param array $options array of options for the mysqldump command
	 * @param string $location the location to dump the contents to
	 */
	protected function runDump($options, $location) {
		$extraOptions = "";
		
		// Since the dump command doesn't (always) have this options, we just do it the old fashioned way
		if($found = array_search("--skip-auto-increment", $options)) {
			$extraOptions .= " | sed 's/ AUTO_INCREMENT=[0-9]*//'";
			unset($options[$found]);
		}
		
		exec(MYSQLDUMP_COMMAND.' --user='.DB_USERNAME.' --password='.DB_PASSWORD.' --host='.DB_HOST.' '.DB_NAME.' '.implode(" ",$options).$extraOptions.' > '.$location);
		echo "Dumped to ".$location."\n";
	}
	
	/**
	 * Convert all table names to Yii-styled raw table names: {{table_name}}
	 * @param string $location the location of the dumped file
	 * @param string $prefix the prefix of the tables to strip off
	 */
	protected function paramTableNames($location, $prefix) {
		$content = file_get_contents($location);
		$content = preg_replace('/`'.$prefix.'(\w+)`/', '`{{${1}}}`', $content);
		return file_put_contents($location, $content);
	}
	
	/**
	 * This command will dump the current database as specified in the config file.
	 * @param boolean $all enable when just a blind dump of everything is wanted
	 * @param boolean $trueTableNames enable this to skip the param conversion step for the table names
	 * @param string $prefix the current prefix that is in use inside the database, defaults to 'tbl_'
	 */
    public function actionDump($all = false, $trueTableNames = false, $prefix = "tbl_") {
    	if($all) {
    		$dumpLocation = YiiBase::getPathOfAlias('application.data')."/full-dump.mysql.sql";
    		$options = array(
    				'--single-transaction',
    		);
    		$this->runDump($options, $dumpLocation);
    		return 0;
    	}
    	
    	$structureDumpLocation = YiiBase::getPathOfAlias('application.data')."/schema.mysql.sql";
    	$dataDumpLocation = YiiBase::getPathOfAlias('application.data')."/data.mysql.sql";
    	
    	$optionsStructure = array(
    			'--single-transaction',
    			'--no-data',
    			'--skip-auto-increment',
    	);
    	$optionsData = array(
    			'--single-transaction',
    			'--no-create-info',
    			$prefix.'auth_item '.$prefix.'auth_item_child',
    	);
    	
    	$this->runDump($optionsStructure, $structureDumpLocation);
    	$this->runDump($optionsData, $dataDumpLocation);
    	
    	if(!$trueTableNames) {
    		$this->paramTableNames($structureDumpLocation, $prefix);
    		$this->paramTableNames($dataDumpLocation, $prefix);
    	}
    	
    	return 0;
    }
    
    /**
     * Info about this command
     * @return string plain info
     */
    public function getHelp(){
    	return "Run 'yiic database dump' to dump the active database structure and auth-data.
    			
Credentials are taken from the config file.

Extra options for 'dump':
--all                         : dump the complete database, structure + data.
--trueTableNames              : skip the param conversion step for the table names.
--prefix [defaults to 'tbl_'] : set the prefix that is used within the current database.\n";
    }
}