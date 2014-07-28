<?php

class m140728_084353_add_spray extends CDbMigration
{
	public $tableNameSpray = 'spray';
	public $tableNameBlock = 'block';
	public $tableNameChemical = 'chemical';
	
	public function updateTablePrefix()
	{
		$this->tableNameSpray = $this->dbConnection->tablePrefix . $this->tableNameSpray;
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNameChemical = $this->dbConnection->tablePrefix . $this->tableNameChemical;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_spray.sql'));
		//rename table with prefix
		$this->renameTable('spray',$this->tableNameSpray);
		
		//rename column
		$this->renameColumn($this->tableNameSpray,'spray_id','id');
		$this->renameColumn($this->tableNameSpray,'spray_date','date');
		$this->renameColumn($this->tableNameSpray,'spray_quantity','quantity');
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameSpray,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameSpray,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameSpray,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameSpray,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameSpray,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameSpray,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameSpray,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameSpray.'_ibfk_1',$this->tableNameSpray);
		$this->dropForeignKey($this->tableNameSpray.'_ibfk_2',$this->tableNameSpray);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameSpray.'_ibfk_1', $this->tableNameSpray,'chemical_id', $this->tableNameChemical, 'id','CASCADE','CASCADE');
		$this->addForeignKey($this->tableNameSpray.'_ibfk_2', $this->tableNameSpray,'block_id', $this->tableNameBlock, 'id','CASCADE','CASCADE');

		return true;
	}

	public function down()
	{
		echo "m140728_084353_add_spray migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameSpray);
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