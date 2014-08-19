<?php

class m140725_090435_add_grower extends CDbMigration
{
	public $tableNameGrower = 'grower';
	
	public function updateTablePrefix()
	{
		$this->tableNameGrower = $this->dbConnection->tablePrefix . $this->tableNameGrower;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_grower.sql'));
		//rename table with prefix
		$this->renameTable('grower',$this->tableNameGrower);
		
		//rename column
		$this->renameColumn($this->tableNameGrower,'grower_id','id');
		$this->renameColumn($this->tableNameGrower,'grower_name','name');
		$this->renameColumn($this->tableNameGrower,'grower_username','username');
		$this->renameColumn($this->tableNameGrower,'grower_password','password');
		$this->renameColumn($this->tableNameGrower,'grower_email','email');
		$this->renameColumn($this->tableNameGrower,'grower_enabled','enabled');
		$this->renameColumn($this->tableNameGrower,'grower_reporting','reporting');
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameGrower,'resetpassword_key', 'varchar(45) NULL COMMENT "A reset password key"');
		$this->addColumn($this->tableNameGrower,'salt', 'varchar(8) NOT NULL COMMENT "A token used to encode the password"');
		$this->addColumn($this->tableNameGrower,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameGrower,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameGrower,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameGrower,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameGrower,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameGrower,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameGrower,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		// convert Convert Unencrypted Password Column to MD5 Hash
		$this->execute('UPDATE '.$this->tableNameGrower.' SET password = MD5(password)');
		
		return true;
	}
	public function down()
	{
		echo "m140725_090435_add_grower migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameGrower);
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}