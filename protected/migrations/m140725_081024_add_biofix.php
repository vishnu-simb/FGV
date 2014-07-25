<?php

class m140725_081024_add_biofix extends CDbMigration
{
	public $tableNameBiofix = 'biofix';
	
	public function updateTablePrefix()
	{
		$this->tableNameBiofix = $this->dbConnection->tablePrefix . $this->tableNameBiofix;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_biofix.sql'));
		$this->execute('RENAME TABLE biofix TO '.$this->tableNameBiofix);
	
	}
	public function down()
	{
		echo "m140725_081024_add_biofix does not support migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameBiofix);
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