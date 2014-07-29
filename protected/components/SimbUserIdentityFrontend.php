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
        /* @var $user WpUser */
        $user = WpUser::model()->findByAttributes(
            array(),
            '(user_login = :username) AND user_status = 0',
            array(':username' => $this->username)
        );

        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {
            if (!$user->validatePassword($user->user_pass, $this->password)) {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            } else {
                $this->_id = $user->ID;
                $this->username = $user->user_login;
                $this->errorCode = self::ERROR_NONE;
            }
        }
        return !$this->errorCode;
    }
}