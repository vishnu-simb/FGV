<?php

class m140821_112133_update_mite extends CDbMigration
{
	
	public $tableNameMite = 'mite';
	public $tableNameMiteMonitor = 'mite_monitor';
	public $tableNameBlock = 'block';
	
	public function updateTablePrefix()
	{
		$this->tableNameMite = $this->dbConnection->tablePrefix . $this->tableNameMite;
		$this->tableNameMiteMonitor = $this->dbConnection->tablePrefix . $this->tableNameMiteMonitor;
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
	
	}
	
	public function up()
	{
		$this->updateTablePrefix();
     
		$this->insert($this->tableNameMite, array(
				'id' => 1,
				'name' => 'Bryobya Mite',
				'type' => 'pest',
		
				// Common fields, should appear in all tables
				'creator_id' => 0,
				'ordering' => 0,
				'created_at' => gmdate('Y-m-d H:i:s'),
				'updated_at' => gmdate('Y-m-d H:i:s'),
				'status' => AppConst::USER_ACTIVE,
				'is_deleted' => AppConst::DELETED_FALSE,
				'params' => null,
		));
		
		$this->insert($this->tableNameMite, array(
				'id' => 2,
				'name' => 'Twospotted Mite',
				'type' => 'pest',
		
				// Common fields, should appear in all tables
				'creator_id' => 0,
				'ordering' => 0,
				'created_at' => gmdate('Y-m-d H:i:s'),
				'updated_at' => gmdate('Y-m-d H:i:s'),
				'status' => AppConst::USER_ACTIVE,
				'is_deleted' => AppConst::DELETED_FALSE,
				'params' => null,
		));
		
		$this->insert($this->tableNameMite, array(
				'id' => 3,
				'name' => 'European Red Mite',
				'type' => 'pest',
		
				// Common fields, should appear in all tables
				'creator_id' => 0,
				'ordering' => 0,
				'created_at' => gmdate('Y-m-d H:i:s'),
				'updated_at' => gmdate('Y-m-d H:i:s'),
				'status' => AppConst::USER_ACTIVE,
				'is_deleted' => AppConst::DELETED_FALSE,
				'params' => null,
		));

		return true;
	}

	public function down()
	{
		echo "m140821_112133_update_mite does not support migration down.\n";
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