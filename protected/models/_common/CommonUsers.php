<?php

Yii::import('application.models._base.BaseUsers');

class CommonUsers extends BaseUsers
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
    			array('type', 'required'),
    			array('password', 'required' ,'except' => 'update'),
    	);
    }
    
 	public function beforeSave(){
 		
        if (parent::beforeSave()) {
            $format = Yii::app()->params['dbDateFormat'];
            $postData = Yii::app()->request->getPost('Users');
            
            if ($this->isNewRecord) {
                $this->created_at = date($format);
                $this->salt = $this->saltGenerator();
                $this->password = md5($this->salt.$this->password);
                $this->creator_id = 0;
                $this->ordering = 0;
            }

            if(!empty($postData['password'])){
            	$this->password = md5($this->salt.$postData['password']);
            }
            $this->updated_at = date($format);
            
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password)
    {
    	return md5($this->salt.$password)===$this->password;
    }
    
    /**
     * Generates the password salt.
     * @return  string salt
     */
    public function saltGenerator()
    {
    	return '$2y$07$'.strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    }
}