<?php

class m140725_090604_add_property extends CDbMigration
{
	public $tableNameProperty = 'property';
	
	public function updateTablePrefix()
	{
		$this->tableNameProperty = $this->dbConnection->tablePrefix . $this->tableNameProperty;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_property.sql'));
		//rename table with prefix
		$this->renameTable('property',$this->tableNameProperty);
		
		//rename colum propety_id to id
		$this->renameColumn($this->tableNameProperty,'property_id','id');
		
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameProperty,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameProperty,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameProperty,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameProperty,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameProperty,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameProperty,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameProperty,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		return true;
	}
	

	public function down()
	{
		echo "m140725_090604_add_property migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameProperty);
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