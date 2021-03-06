<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/19/14
 * Time: 3:51 PM
 *
 * Backend use only
 */
class SimbUserIdentityBackend extends SimbUserIdentity
{
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
                $this->setState('role', $user->type);
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }
}
