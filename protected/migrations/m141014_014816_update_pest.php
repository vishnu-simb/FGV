<?php

class m141014_014816_update_pest extends CDbMigration
{
	
	public $tableNamePest = 'pest';
	
	public function updateTablePrefix()
	{
		$this->tableNamePest = $this->dbConnection->tablePrefix . $this->tableNamePest;

	}
	
	public function up()
	{
		$this->updateTablePrefix();
		$this->addColumn($this->tableNamePest,'color', 'VARCHAR(100) NULL COMMENT "color of pest mites and predators mites" AFTER calculate');
		return true;
	}

	public function down()
	{
		echo "m141014_014816_update_pest migration down.\n";
		$this->updateTablePrefix();
		$this->dropColumn($this->tableNamePest,'color');
		return false;
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