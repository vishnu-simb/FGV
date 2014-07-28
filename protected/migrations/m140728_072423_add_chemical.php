<?php

class m140728_072423_add_chemical extends CDbMigration
{

	public $tableNameChemical = 'chemical';
	
	public function updateTablePrefix()
	{
		$this->tableNameChemical  = $this->dbConnection->tablePrefix . $this->tableNameChemical;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_chemical.sql'));
		//rename table with prefix
		$this->renameTable('chemical',$this->tableNameChemical);
		
		
		//rename column
		$this->renameColumn($this->tableNameChemical,'chemical_id','id');
		$this->renameColumn($this->tableNameChemical,'chemical_name','name');
		$this->renameColumn($this->tableNameChemical,'chemical_pack_qty','pack_qty');
		$this->renameColumn($this->tableNameChemical,'chemical_pack_price','pack_price');
		$this->renameColumn($this->tableNameChemical,'chemical_dilution_rate','dilution_rate');
		$this->renameColumn($this->tableNameChemical,'chemical_application_rate','application_rate');
		
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameChemical,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameChemical,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameChemical,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameChemical,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameChemical,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameChemical,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameChemical,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');

		return true;
	}
	public function down()
	{
		echo "m140728_072423_add_chemical migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameChemical);
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