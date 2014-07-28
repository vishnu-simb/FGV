<?php

class m140728_084337_add_sizing extends CDbMigration
{
	public $tableNameSizing = 'sizing';
	public $tableNameBlock = 'block';
	public $tableNameVariety = 'variety';
	
	public function updateTablePrefix()
	{
		$this->tableNameSizing = $this->dbConnection->tablePrefix . $this->tableNameSizing;
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNameVariety = $this->dbConnection->tablePrefix . $this->tableNameVariety;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_sizing.sql'));
		//rename table with prefix
		$this->renameTable('sizing',$this->tableNameSizing);
		
		//rename column
		$this->renameColumn($this->tableNameSizing,'sizing_id','id');
		$this->renameColumn($this->tableNameSizing,'sizing_date','date');
		$this->renameColumn($this->tableNameSizing,'sizing_value','value');
		$this->renameColumn($this->tableNameSizing,'sizing_type','type');
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameSizing,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameSizing,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameSizing,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameSizing,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameSizing,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameSizing,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameSizing,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameSizing.'_ibfk_1',$this->tableNameSizing);
		$this->dropForeignKey('fk_sizing_variety1',$this->tableNameSizing);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameSizing.'_ibfk_1', $this->tableNameSizing,'block_id', $this->tableNameBlock, 'id','CASCADE','CASCADE');
		$this->addForeignKey($this->tableNameSizing.'_ibfk_2', $this->tableNameSizing,'variety_id', $this->tableNameVariety, 'id','NO ACTION','NO ACTION');

		return true;
	}

	public function down()
	{
		echo "m140728_084337_add_sizing migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameSizing);
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