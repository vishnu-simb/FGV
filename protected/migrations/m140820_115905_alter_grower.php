<?php

class m140820_115905_alter_grower extends CDbMigration
{
	public function up()
	{
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameGrower,'avatar', 'varchar(255) NULL AFTER mobile');
		return true;
	}

	public function down()
	{
		echo "m140820_115905_alter_grower does not support migration down.\n";
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