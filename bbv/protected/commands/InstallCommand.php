<?php

Yii::import('application.components.Install');

/**
 * A command to install the CMS
 * 
 * If you're installing on a Mac with MAMP, you might need to do this before connection testing will work:
 * $ ln -s /Applications/MAMP/tmp/mysql/mysql.sock /tmp/mysql.sock
 * $ ln -s /Applications/MAMP/tmp/mysql/mysql.sock /var/mysql/mysql.sock
 * 
 * @author Ruben Taelman
 *
 */
class InstallCommand extends CConsoleCommand
{
	
	public function run() {
		echo "[WARNING]: Any existing installation on this location will be OVERWRITTEN, so make sure you're certain you want to continue. CTRL+C to quit.\n";
		echo "Config settings:\n----------------\n";
		$data_set = false;
		while(!$data_set) {
			$data = array();
			foreach(Install::$CONFIG_KEYS as $key) {
				$data[$key] = $this->prompt($key.":");
			}
			
			if(!Install::testConnection($data['DB_HOST'], $data['DB_USERNAME'], $data['DB_PASSWORD'], $data['DB_NAME']))
				echo "Couldn't connect to the database with the given credentials, please try again.\n";
			else
				$data_set = true;
		}
		
		echo "Admin account:\n--------------\n";
		$username = $this->prompt("username:");
		$pwd_set = false;
		while(!$pwd_set) {
			$password = $this->prompt("password:");
			$password_repeat = $this->prompt("password(2):");
			if($password != $password_repeat)
				echo "Please re-enter the password, and make sure you type it exactly thesame twice.";
			else
				$pwd_set = true;
		}
		
		echo "\nInstalling...\n";
		Install::completeInstall($data, $username, $password);
		echo "Installed!\n";
		return 0;
	}
    
    /**
     * Info about this command
     * @return string plain info
     */
    public function getHelp(){
    	return "Run 'yiic install' to install the application
    			
Credentials are taken from the config file.

Extra options for 'dump':
--all                         : dump the complete database, structure + data.
--trueTableNames              : skip the param conversion step for the table names.
--prefix [defaults to 'tbl_'] : set the prefix that is used within the current database.\n";
    }
}