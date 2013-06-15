<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_USERNAME_NOTACTIVATED=3;
	private $_id;
	
	/*
	 * Authentication trough the User model
	 * @param fb if authentication will go via facebook
	 * @return boolean if the authentication succeeds.
	 */
	public function authenticate($fb=false)
	{
		$user=User::model()->findByAttributes(array('name'=>$this->username));
		if($user===null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
		{
			if($user->pwd!==$user->encode($this->password))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->_id=$user->id;
				$this->setState('fbid', $user->fbid);
				$this->errorCode=self::ERROR_NONE;
			}
		}
		
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
}