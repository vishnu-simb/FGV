<?php

Yii::import('application.models._common.CommonGrower');

class Grower extends CommonGrower
{
	
	public $temp_password;
	
	public static function model($className=__CLASS__)
    {
		return parent::model($className);
	}
	
	function getProperties(){
		return Property::model()->findAll('grower_id='.$this->id);
	}

    function getPestsDataProvider(){
        $sql="SELECT * FROM ".Pest::model()->tableName()." ORDER BY ordering";
        return new CSqlDataProvider($sql, array());
    }
	
	/**
	 * reset password
	 */
	public function resetPassword(){
		
		$this->temp_password = $this->passwordGenerator();
		$this->salt = $this->saltGenerator();
		$this->b_password = base64_encode($this->temp_password);
		$this->password = md5($this->salt.$this->temp_password);
		// create some mailing here
	}
	
	/**
	 * generate reset password key
	 */
	public function generateResetpasswordKey(){
		$this->resetpassword_key = $this->passwordGenerator();
	}
	
	
}