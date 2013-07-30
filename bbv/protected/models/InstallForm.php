<?php

/**
 * InstallForm class.
 * InstallForm is the data structure for keeping
 * installation configuration data. It is used by the 'install' action of 'SiteController'.
 */
class InstallForm extends CFormModel
{
	
	public $DB_HOST;
	public $DB_NAME;
	public $DB_USERNAME;
	public $DB_PASSWORD;
	public $TBL_PREFIX;
	public $MYSQLDUMP_COMMAND;
	
	public $username;
	public $password;
	public $password_repeat;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD, username, password', 'required'),
			array('password', 'compare'),
			array('password','ext.validators.EPasswordStrength', 'min'=>6),
			array('TBL_PREFIX, MYSQLDUMP_COMMAND', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'DB_HOST'=>Yii::t('messages', 'form.install.db_host'),
			'DB_NAME'=>Yii::t('messages', 'form.install.db_name'),
			'DB_USERNAME'=>Yii::t('messages', 'form.install.db_username'),
			'DB_PASSWORD'=>Yii::t('messages', 'form.install.db_password'),
			'TBL_PREFIX'=>Yii::t('messages', 'form.install.tbl_prefix'),
			'MYSQLDUMP_COMMAND'=>Yii::t('messages', 'form.install.mysqldump_command'),
			'username'=>Yii::t('messages', 'model.user.name'),
			'password'=>Yii::t('messages', 'model.user.pwd'),
			'password_repeat'=>Yii::t('messages', 'model.user.pwd_repeat'),
		);
	}
	
	/**
	 * Tests the database connection before allowing saving
	 * @return true if the connection tested succesfully
	 */
	public function testConnection()
	{
		if($this->hasErrors()) return false;
		return Install::testConnection($this->DB_HOST, $this->DB_USERNAME, $this->DB_PASSWORD, $this->DB_NAME);
	}
	
	/**
	 * Prepares the data map that can be given to the installation component
	 * @param array $keys a row of keys
	 * @return array mapping of keys to values
	 */
	public function prepareData($keys) {
		$data = array();
		foreach($keys as $key) {
			$data[$key]  = $this->{$key};
		}
		return $data;
	}
}
