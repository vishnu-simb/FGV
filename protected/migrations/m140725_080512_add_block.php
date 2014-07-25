<?php

class m140725_080512_add_block extends CDbMigration
{
	public $tableNameBlock = 'block';
	
	public function updateTablePrefix()
	{
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_block.sql'));
		$this->execute('RENAME TABLE block TO '.$this->tableNameBlock);
	
	}

	public function down()
	{
		echo "m140725_080512_add_block does not support migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameBlock);
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