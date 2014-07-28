<?php

class m140728_084401_add_trap extends CDbMigration
{
	public $tableNameTrap = 'trap';
	public $tableNameBlock = 'block';
	public $tableNamePest = 'pest';
	
	public function updateTablePrefix()
	{
		$this->tableNameTrap = $this->dbConnection->tablePrefix . $this->tableNameTrap;
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNamePest = $this->dbConnection->tablePrefix . $this->tableNamePest;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_trap.sql'));
		//rename table with prefix
		$this->renameTable('trap',$this->tableNameTrap);
		
		//rename column
		$this->renameColumn($this->tableNameTrap,'trap_id','id');
		$this->renameColumn($this->tableNameTrap,'trap_name','name');
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameTrap,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameTrap,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameTrap,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameTrap,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameTrap,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameTrap,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameTrap,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameTrap.'_ibfk_1',$this->tableNameTrap);
		$this->dropForeignKey($this->tableNameTrap.'_ibfk_2',$this->tableNameTrap);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameTrap.'_ibfk_1', $this->tableNameTrap,'pest_id', $this->tableNamePest, 'id','CASCADE','CASCADE');
		$this->addForeignKey($this->tableNameTrap.'_ibfk_2', $this->tableNameTrap,'block_id', $this->tableNameBlock, 'id','CASCADE','CASCADE');

		return true;
	}

	public function down()
	{
		echo "m140728_084401_add_trap migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameTrap);
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