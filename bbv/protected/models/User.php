<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $datereg
 * @property string $pwd
 * @property string $gender
 * @property string $fbid
 */
class User extends CActiveRecord
{
	public $pwd_repeat;
	public $verifyCode;
	public $newPwd;
	public $newPwd_repeat;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, mail', 'unique', 'on'=>'register'),
			array('mail', 'email', 'on'=>'register'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'register'),
			array('pwd', 'compare', 'on'=>'register'),
			array('pwd','ext.validators.EPasswordStrength', 'min'=>6, 'on'=>'register'),
			array('newPwd', 'compare', 'on'=>'ChangePassword'),
			array('newPwd','ext.validators.EPasswordStrength', 'min'=>6, 'on'=>'ChangePassword'),
			array('pwd, newPwd, newPwd_repeat', 'required', 'on'=>'ChangePassword'),
			array('name, pwd, pwd_repeat, mail', 'required', 'on'=>'register'),
			array('mail', 'email','checkMX'=>true, 'on'=>'register'), //check if domain exists
			array('name', 'length', 'max'=>50, 'on'=>'register'),
			array('mail, pwd', 'length', 'max'=>50, 'on'=>'register'),
			array('gender', 'length', 'max'=>1, 'on'=>'register'),
			array('pwd_repeat', 'safe', 'on'=>'register'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, mail, pwd, gender', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('form', 'ID: '),
			'name' => Yii::t('form', 'Naam: '),
			'mail' => Yii::t('form', 'E-Mail: '),
			'datereg' => Yii::t('form', 'Datum van registratie: '),
			'pwd' => Yii::t('form', 'Wachtwoord: '),
			'pwd_repeat' => Yii::t('form', 'Wachtwoord (herhaling): '),
			'newPwd' => Yii::t('form', 'Nieuw wachtwoord: '),
			'newPwd_repeat' => Yii::t('form', 'Nieuw wachtwoord (herhaling): '),
			'gender' => Yii::t('form', 'Geslacht: '),
			'verifyCode' => Yii::t('form', 'Verificatie Code: '),
			'fbid' => Yii::t('form', 'Facebook ID: '),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('fbid',$this->fbid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Prepares datereg, lastip, admin, confirm, fbid, ofb and avat
	 */
	 protected function beforeValidate()
	 {
		$this->datereg=date('m.d.y');
		$this->fbid='';
		
		return parent::beforeValidate();
	 }
	 
	 /**
	  * Encrypt pwd for storage in database
	  */
	 protected function afterValidate()
	 {
		parent::afterValidate();
		$this->pwd=$this->encode($this->pwd);  
	 }
	 
	 /**
	  * Generates a new password for a given username
	  */
	 public function generateNewPassword($name)
	 {
		$newpwd=uniqid();
		$user=User::model()->findByAttributes(array('name'=>$name));
		$user->pwd=$this->encode($newpwd);
		$user->save(false);
		return $newpwd;
	 }
	 
	 /**
	  * Sends a confirmation link to a newly registered user
	  */
	 public function mailNewPassword($name, $mail, $pwd)
	 {
		$subject = 'TGC Games Password Recovery';
		$message = "Hi ".$name.",\r\n\r\n".
					"You have just recovered your account.\r\nBelow you can see your newly generated password. Keep it if you like it, or change it if you don't.\r\nPassword: ".$pwd."\r\n\r\nIf you didn't want to change your password, that means someone else knows your secret answer.\r\nIn that case, log in to your account with this new password and change your secret question and answer as fast as possible.\r\n\r\n".
					"Friendly regards,\r\nTGC Games";
		$headers = 'From:  TGC Games Password Recovery <register@tgcgames.com>' . "\r\n" .
			'Reply-To: info&@tgcgames.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		mail($mail, $subject, $message, $headers); 
	 }
	 
	 /**
	  * MD5 encode method
	  */
	 public function encode($hash)
	 {
		return md5($hash);
	 }
	  
	  /**
	   * Setup the CAPTCHA
	   */
	  public function actions()    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
        );
    }
	
	/**
	 * Get the name of a userid
	 */
	public function getName($id)
	{
		$criteria = new CDbCriteria;
		$criteria->select = 'id, name';
		$user=User::model()->findByPk($id, $criteria);
		return $user->name;
	}
}