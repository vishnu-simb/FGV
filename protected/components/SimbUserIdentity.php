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
} 