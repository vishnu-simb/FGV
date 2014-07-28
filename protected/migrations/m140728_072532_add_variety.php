<?php

class m140728_072532_add_variety extends CDbMigration
{
	public $tableNameVariety = 'variety';
	
	public function updateTablePrefix()
	{
		$this->tableNameVariety  = $this->dbConnection->tablePrefix . $this->tableNameVariety;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_variety.sql'));
		//rename table with prefix
		$this->renameTable('variety',$this->tableNameVariety);
		//rename column
		$this->renameColumn($this->tableNameVariety,'variety_id','id');
		$this->renameColumn($this->tableNameVariety,'variety_name','name');
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameVariety,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameVariety,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameVariety,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameVariety,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameVariety,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameVariety,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameVariety,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		
		return true;
	}

	public function down()
	{
		echo "m140728_072532_add_variety migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameVariety);
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