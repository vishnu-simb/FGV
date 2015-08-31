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
    	return CMap::mergeArray(parent::rules(),array(
    		)
    	);
    }
    
    /**
     * scope of yii
     * @return array
     * @see scope of yii
     */
    public function scopes(){
    	return array(
    			'byname'=>array(
    					'order'=>'name'
    			)
    	);
    }
    
    public function beforeSave(){
    	if (parent::beforeSave()) {
    		$format = Yii::app()->params['dbDateFormat'];
    		if ($this->isNewRecord) {
    			$this->created_at = date($format);
    			$this->salt = $this->saltGenerator();
    			$this->password = md5($this->salt.$this->password);
    			$this->creator_id = 0;
    			$this->ordering = 0;
    		}else{
    			if(!empty($this->password)){
    				$this->password = $this->hashPassword($this->password);
    			}else{
    				unset($this->password);
    			}
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
    public function saltGenerator($lengh = 8)
    {
    	return substr('$2y$07$'.strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'), 0, $lengh);
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
        return $this->byname()->findAll();
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

    /**
     * @return grower
     */
    public function getByName($name){
    	return self::model()->find('LOWER(name) = :name', array('name' => strtolower($name)));
    }
 
}
