<?php
/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/30/14
 * Time: 6:09 PM
 *
 * Frontend use only
 */
class SimbUserIdentityFrontend extends SimbUserIdentity
{
    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
 	public function authenticate()
    {
      
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
            } else {  // Okay!
                $this->_id = $user->id;
                $this->username = $user->username;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }
}