<?php
/**
 * 
 * EPasswordStrength class
 * 
 * Validate if password is strong enought
 *
 * The validator check if password has at least min characters,
 * and if password contain at least one lower case letter, at least one upper case letter,
 * and at least one number
 * 
 *
 *
 *
 * @see      http://www.yiiframework.com
 * @version  1.0
 * @access   public
 * @author   ivica Nedeljkovic (ivica.nedeljkovic@gmail.com)
 */
class EPasswordStrength extends CValidator{
    
    //Minimum password length
    public $min = 7;
    
    /**
	 * (non-PHPdoc)
	 * @see CValidator::validateAttribute()
	 */
    protected function validateAttribute($object,$attribute){
       if(!$this->checkPasswordStrength($object->$attribute)){
            $message=$this->message!==null?$this->message:Yii::t("EPasswordStrength","{attribute} is zwak. {attribute} moet tenminste {$this->min} karakters bevatten en minstens 1 getal.");
			$this->addError($object,$attribute,$message);
       }
    }
    
    /**
     * Check if password is strong enought
     * @param string $password
     * @return boolean 
     */
    protected function checkPasswordStrength($password){
        if (preg_match("/^.*(?=.{" . $this->min . ",})(?=.*\d).*$/", $password)) {// (?=.*[a-z])(?=.*[A-Z])
            return true;
        } else {
            return false;
        }
    }
        
}

