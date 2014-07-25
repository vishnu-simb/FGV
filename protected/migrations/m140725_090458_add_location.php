<?php

class m140725_090458_add_location extends CDbMigration
{
	public $tableNameLocation = 'location';
	
	public function updateTablePrefix()
	{
		$this->tableNameLocation = $this->dbConnection->tablePrefix . $this->tableNameLocation;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_location.sql'));
		//rename table with prefix
		$this->renameTable('location',$this->tableNameLocation);
		
		//rename colum propety_id to id
		$this->renameColumn($this->tableNameLocation,'location_id','id');
		
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameLocation,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameLocation,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameLocation,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameLocation,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameLocation,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameLocation,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameLocation,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		return true;
	}
	
	public function down()
	{
		echo "m140725_090458_add_location migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameLocation);
		return true;
		return false;
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