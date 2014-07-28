<?php

class m140728_072502_add_pest_spray extends CDbMigration
{
public $tableNamePestSpray = 'pest_spray';
	
	public function updateTablePrefix()
	{
		$this->tableNamePestSpray  = $this->dbConnection->tablePrefix . $this->tableNamePestSpray;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_pest_spray.sql'));
		//rename table with prefix
		$this->renameTable('pest_spray',$this->tableNamePestSpray);
		
		
		//rename column
		$this->renameColumn($this->tableNamePestSpray,'pest_id','id');
		$this->renameColumn($this->tableNamePestSpray,'ps_number','number');
		$this->renameColumn($this->tableNamePestSpray,'ps_dd','dd');
		$this->renameColumn($this->tableNamePestSpray,'ps_every','every');
		$this->renameColumn($this->tableNamePestSpray,'ps_lowpop_dd','lowpop_dd');
		$this->renameColumn($this->tableNamePestSpray,'ps_lowpop_every','lowpop_every');
		
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNamePestSpray,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNamePestSpray,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNamePestSpray,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNamePestSpray,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNamePestSpray,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNamePestSpray,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNamePestSpray,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');

		return true;
	}

	public function down()
	{
		echo "m140728_072502_add_pest_spray migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNamePestSpray);
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