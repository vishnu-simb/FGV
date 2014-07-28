<?php

class m140728_064340_add_pest extends CDbMigration
{
	public $tableNamePest = 'pest';
	
	public function updateTablePrefix()
	{
		$this->tableNamePest  = $this->dbConnection->tablePrefix . $this->tableNamePest;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_pest.sql'));
		//rename table with prefix
		$this->renameTable('pest',$this->tableNamePest);
		
		
		//rename column
		$this->renameColumn($this->tableNamePest,'pest_id','id');
		$this->renameColumn($this->tableNamePest,'pest_name','name');
		$this->renameColumn($this->tableNamePest,'pest_dd','dd');
		$this->renameColumn($this->tableNamePest,'pest_calculate','calculate');
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNamePest,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNamePest,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNamePest,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNamePest,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNamePest,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNamePest,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNamePest,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');

		return true;
	}

	public function down()
	{
		echo "m140728_064340_add_pest migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNamePest);
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