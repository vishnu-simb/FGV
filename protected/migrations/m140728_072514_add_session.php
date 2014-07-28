<?php

class m140728_072514_add_session extends CDbMigration
{
	public $tableNameSession = 'session';
	
	public function updateTablePrefix()
	{
		$this->tableNameSession  = $this->dbConnection->tablePrefix . $this->tableNameSession;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_session.sql'));
		//rename table with prefix
		$this->renameTable('session',$this->tableNameSession);
		//rename column
		$this->renameColumn($this->tableNameSession,'session_id','id');
		$this->renameColumn($this->tableNameSession,'session_ip','ip');
		$this->renameColumn($this->tableNameSession,'session_time','time');
		return true;
	}

	public function down()
	{
		echo "m140728_072514_add_session migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameSession);
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