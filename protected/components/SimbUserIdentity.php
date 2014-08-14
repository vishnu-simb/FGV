<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/30/14
 * Time: 6:11 PM
 *
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class SimbUserIdentity extends CUserIdentity
{
    /* @property $_id */
    protected $_id;

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }
    

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
    	/* @var $user WpUser */
    	$user = Users::model()->findByAttributes(
    			array(),
    			'(username = :username) AND is_deleted = 0',
    			array(':username' => $this->username)
    	);
    
    	if ($user === null) {
    		$this->errorCode = self::ERROR_USERNAME_INVALID;
    	} else {
    		if (!$user->validatePassword($this->password)) {
    			$this->errorCode = self::ERROR_PASSWORD_INVALID;
    		} else {
    			$this->_id = $user->id;
    			$this->username = $user->username;
    			$this->errorCode = self::ERROR_NONE;
    		}
    	}
    	return !$this->errorCode;
    }
} 