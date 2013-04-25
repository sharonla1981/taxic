<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        public $email;
        private $_id;
	
        //extend the constructor of CUserIdentity to set the $email attribute.
        public function __construct($email, $password) {
            $this->email = $email;
            $this->password = $password;
        }
        
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('email'=>$this->email));
                if ($user===null)
                {
                    $this->errorCode=  self::ERROR_USERNAME_INVALID;
                }
                else
                {
                    if ($user->password!=$user->encrypt($this->password))
                    {
                        $this->errorCode = self::ERROR_PASSWORD_INVALID;
                    }
                    else
                    {
                        $this->_id = $user->id;
                        if ($user->last_login_time === null)
                        {
                            $lastLogin = time();
                        }
                        else
                        {
                            $lastLogin = strtotime($user->last_login_time);
                        }
                        $this->setState('lastLoginTime', $lastLogin);
                        $this->errorCode = self::ERROR_NONE;
                    }
                }
                
                return !$this->errorCode;
	}
        
        public function getId() 
        { 
            return $this->_id; 
        
        }
        
        public function getName() 
        {
            return $this->email;
        }
}