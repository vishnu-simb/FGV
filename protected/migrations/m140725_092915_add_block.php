<?php

class m140725_092915_add_block extends CDbMigration
{
	public $tableNameBlock = 'block';
	public $tableNameProperty = 'property';
	
	public function updateTablePrefix()
	{
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNameProperty  = $this->dbConnection->tablePrefix . $this->tableNameProperty;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_block.sql'));
		//rename table with prefix
		$this->renameTable('block',$this->tableNameBlock);
		
		
		//rename column
		$this->renameColumn($this->tableNameBlock,'block_id','id');
		$this->renameColumn($this->tableNameBlock,'block_name','name');
		$this->renameColumn($this->tableNameBlock,'block_tree_spacing','tree_spacing');
		$this->renameColumn($this->tableNameBlock,'block_row_width','row_width');
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameBlock,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameBlock,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameBlock,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameBlock,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameBlock,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameBlock,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameBlock,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameBlock.'_ibfk_1',$this->tableNameBlock);
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameBlock.'_ibfk_1', $this->tableNameBlock,'property_id', $this->tableNameProperty, 'id','CASCADE','CASCADE');
		return true;
	}
		

	public function down()
	{
		echo "m140725_092915_add_block migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameBlock);
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