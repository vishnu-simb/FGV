<?php

Yii::import('application.models._base.BaseGrower');

class CommonGrower extends BaseGrower
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function rules()
    {
    	return array(
    			//Applies to 'update' scenario
    			array('username', 'required'),
    			array('password', 'required' ,'except' => 'update'),
    	);
    }
    
    
    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
    	return $password === $this->password;
    }
}
