<?php

class m140728_084416_add_trap_check extends CDbMigration
{
	public $tableNameTrapCheck = 'trap_check';
	public $tableNameTrap = 'trap';
	
	public function updateTablePrefix()
	{
		$this->tableNameTrapCheck = $this->dbConnection->tablePrefix . $this->tableNameTrapCheck;
		$this->tableNameTrap = $this->dbConnection->tablePrefix . $this->tableNameTrap;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_trap_check.sql'));
		//rename table with prefix
		$this->renameTable('trap_check',$this->tableNameTrapCheck);
		
		//rename column
		$this->renameColumn($this->tableNameTrapCheck,'tc_id','id');
		$this->renameColumn($this->tableNameTrapCheck,'tc_date','date');
		$this->renameColumn($this->tableNameTrapCheck,'tc_value','value');
		$this->renameColumn($this->tableNameTrapCheck,'tc_comment','comment');
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameTrapCheck,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameTrapCheck,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameTrapCheck,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameTrapCheck,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameTrapCheck,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameTrapCheck,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameTrapCheck,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameTrapCheck.'_ibfk_1',$this->tableNameTrapCheck);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameTrapCheck.'_ibfk_1', $this->tableNameTrapCheck,'trap_id', $this->tableNameTrap, 'id','CASCADE','CASCADE');

		return true;
	}
	

	public function down()
	{
		echo "m140728_084416_add_trap_check migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameTrapCheck);
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