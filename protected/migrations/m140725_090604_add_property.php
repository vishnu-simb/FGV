<?php

class m140725_090604_add_property extends CDbMigration
{
	public $tableNameProperty = 'property';
	public $tableNameGrower = 'grower';
	public $tableNameLocation = 'location';
	public function updateTablePrefix()
	{
		$this->tableNameProperty = $this->dbConnection->tablePrefix . $this->tableNameProperty;
		$this->tableNameGrower = $this->dbConnection->tablePrefix . $this->tableNameGrower;
		$this->tableNameLocation = $this->dbConnection->tablePrefix . $this->tableNameLocation;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_property.sql'));
		//rename table with prefix
		$this->renameTable('property',$this->tableNameProperty);
		
		//rename column
		$this->renameColumn($this->tableNameProperty,'property_id','id');
		$this->renameColumn($this->tableNameProperty,'property_name','name');

		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameProperty,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameProperty,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameProperty,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameProperty,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameProperty,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameProperty,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameProperty,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameProperty.'_ibfk_1',$this->tableNameProperty);
		$this->dropForeignKey($this->tableNameProperty.'_ibfk_2',$this->tableNameProperty);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameProperty.'_ibfk_1', $this->tableNameProperty,'grower_id', $this->tableNameGrower, 'id','CASCADE','CASCADE');
		$this->addForeignKey($this->tableNameProperty.'_ibfk_2', $this->tableNameProperty,'location_id', $this->tableNameLocation, 'id','CASCADE','CASCADE');

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