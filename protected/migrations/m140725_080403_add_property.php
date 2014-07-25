<?php

class m140725_080403_add_property extends CDbMigration
{
	public $tableNameProperty = 'property';
	
	public function updateTablePrefix()
	{
		$this->tableNameProperty = $this->dbConnection->tablePrefix . $this->tableNameProperty;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		$this->execute(file_get_contents(Yii::app()->request->baseUrl.'/data/old_property.sql'));
		$this->execute('RENAME TABLE property TO '.$this->tableNameProperty);
	
	}


	public function down()
	{
		echo "m140725_080403_add_property does not support migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameProperty);
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