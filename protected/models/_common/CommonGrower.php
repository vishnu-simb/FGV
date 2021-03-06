<?php

Yii::import('application.models._base.BaseGrower');

class CommonGrower extends BaseGrower
{
	var $decoded_password = '';

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function rules()
    {
    	return CMap::mergeArray(parent::rules(),array());
    }

    public function attributeLabels()
    {
    	$att_labels= parent::attributeLabels();
	    $att_labels['decoded_password'] = Yii::t('app', 'Password');
	    return $att_labels;
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
			    $this->b_password = base64_encode($this->password);
    			$this->password = md5($this->salt.$this->password);
    			$this->creator_id = 0;
    			$this->ordering = 0;
    		}else{
    			if(!empty($this->password)){
				    $this->b_password = base64_encode($this->password);
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
	    if (function_exists('random_bytes'))
	    	return substr('$2y$07$'.strtr(base64_encode(random_bytes(16)), '+', '.'), 0, $lengh);
	    else
    	    return substr('$2y$07$'.strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'), 0, $lengh);
    }
    
    /**
     * Generates the password.
     * @return  string temp_password
     */
    public function passwordGenerator()
    {
	    if (function_exists('random_bytes'))
		    return strtr(base64_encode(random_bytes(16)), '+', '.');
	    else
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
    
    /**
     * @return Grower[]
     */
    public function findAllActive()
    {
        return $this->byname()->findAll("enabled='yes'");
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



    function getPestsDataProvider($fruit_type_id = ''){
        $sql="SELECT * FROM ".CropPest::model()->tableName().($fruit_type_id?" WHERE fruit_type_id = '$fruit_type_id'":"")." ORDER BY ordering";
        return new CSqlDataProvider($sql, array(
            'pagination'=>false,
        ));
    }

    public function getBlockByGrower(){
        $where = '';
        if ($this->id)
            $where = " WHERE g.id = $this->id ";
        $sql="SELECT b.id as id,b.name as name,CONCAT (g.name,' - ',p.name,' - ',b.name) AS block_name, v.fruit_type_id, ft.name as fruit_type
		FROM ".Block::model()->tableName()." b
    			INNER JOIN ".Property::model()->tableName()." p ON b.property_id = p.id
    			INNER JOIN ".Grower::model()->tableName()." g ON p.grower_id = g.id  
		        LEFT JOIN ".Variety::model()->tableName()." v ON v.id = b.tree_variety 
		        LEFT JOIN ".FruitType::model()->tableName()." ft ON ft.id = v.fruit_type_id 
        $where   
    	ORDER BY g.name";
        return new CSqlDataProvider($sql, array(
            'pagination'=>false,
        ));
    }

}
