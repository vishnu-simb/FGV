<?php

class m140728_072443_add_degree_day extends CDbMigration
{
	public $tableNameDegreeDay = 'degree_day';
	
	public function updateTablePrefix()
	{
		$this->tableNameDegreeDay  = $this->dbConnection->tablePrefix . $this->tableNameDegreeDay;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_degree_day.sql'));
		//rename table with prefix
		$this->renameTable('degree_day',$this->tableNameDegreeDay);

		return true;
	}

	public function down()
	{
		echo "m140728_072443_add_degree_day migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameDegreeDay);
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