<?php

/**
 * Author: trac.nguyen (npbtrac@yahoo.com)
 * Date: 6/30/14
 * Time: 1:58 PM
 *
 * common WebUser class for the app
 */
class SimbWebUser extends CWebUser
{
    /* @property $params for storing options, settings ... of a user */
    public $params = array();

    /**
     * Set key => value to the params array
     * @param $key
     * @param $value
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * Get the value of a single key in param array
     * @param $key
     * @param null $default
     * @return null
     */
    
    public function getParam($key, $default = null)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        } else {
            return $default;
        }
    }
    
    /**
     * User Type Value "Admin"
     */
    
    function isAdmin(){
    	$user = Users::model()->findByPk(Yii::app()->user->id);
    	if(isset($user)){
    		return $user->type== Users::USER_TYPE_ADMIN;
    	}else return false;
    	
    }
    
    function isGrower(){
        return Grower::model()->find('username = ?', array(Yii::app()->user->name));
    }
} 