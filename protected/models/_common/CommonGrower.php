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
    	
			array('name, email, username', 'required', 'except' => 'search'),
    		array('username','unique'),
    		array('password,_repassword','required', 'except' => 'update'),
    		array('_repassword','compare','compareAttribute'=>'password'),
    		array('username', 'length', 'max'=>45),
    		array('ordering, status, is_deleted, postcode', 'numerical', 'integerOnly'=>true),
    		array('name, contact_name', 'length', 'max'=>100),
    		array('password,_repassword', 'length', 'max'=>32),
    		array('salt', 'length', 'max'=>8),
    		array('enabled', 'length', 'max'=>3),
    		array('reporting', 'length', 'max'=>7),
    		array('address', 'length', 'max'=>255),
            array('suburb', 'length', 'max'=>50),
			array('creator_id, phone, mobile', 'length', 'max'=>20),
    		array('created_at, updated_at, params', 'safe'),
            array('avatar', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
    		array('enabled, reporting, contact_name, address, suburb, postcode, state, phone, mobile, creator_id, ordering, created_at, updated_at, status, is_deleted, params', 'default', 'setOnEmpty' => true, 'value' => null),
    		array('id, name, username, password, email, enabled, reporting, creator_id, ordering, created_at, updated_at, status, is_deleted, params, rowsPerPage', 'safe', 'on'=>'search'),
    	);
    }
    public function beforeSave(){
    		
    	if (parent::beforeSave()) {
    		$format = Yii::app()->params['dbDateFormat'];
    		$postData = Yii::app()->request->getPost('Grower');
    		
    		if ($this->isNewRecord) {
    			$this->created_at = date($format);
    			$this->salt = $this->saltGenerator();
    			$this->password = md5($this->salt.$this->password);
    			$this->creator_id = 0;
    			$this->ordering = 0;
    		}
    
    		if(!empty($postData['password'])){
    			$this->password = $this->hashPassword($postData['password']);
    		}
    		$this->updated_at = date($format);
    
    		return true;
    	} else {
    		return false;
    	}
    }
    
    public function hashPassword($password){
    	return md5($this->salt.$password);
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
    
    /**
     * Generates the password.
     * @return  string temp_password
     */
    public function passwordGenerator()
    {
    	return strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
    }
    
    /**
     * @return Grower[]
     */
    public function findAllPk($grower_id){
    	  $this->getDbCriteria()->mergeWith(array(
            'condition'=>$this->getTableAlias().'.id=:grower_id',
            'params'=>array(':grower_id'=>$grower_id),
        ));
        return $this->findAll();
    }
    
    function getProperties(){
    	return Property::model()->findAll('grower_id='.$this->id);
    }
    
    /**
     * @return Block[]
     */
    public function getBlock(){
    	$a = array();
    	foreach($this->getProperties() as $p){
    		$a = array_merge($a,$p->getBlocks());
    	}
    	return $a;
    	
    }
    
 
}
