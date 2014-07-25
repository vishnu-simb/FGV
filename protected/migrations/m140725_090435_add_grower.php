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
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_grower.sql'));
		//rename table with prefix
		$this->renameTable('grower',$this->tableNameGrower);
		
		//rename colum propety_id to id
		$this->renameColumn($this->tableNameGrower,'grower_id','id');
		
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameGrower,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameGrower,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameGrower,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameGrower,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameGrower,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameGrower,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameGrower,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
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