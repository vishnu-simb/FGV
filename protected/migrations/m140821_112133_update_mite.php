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
				'type' => 'Pest',
				'color' => '#75e112',
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
				'type' => 'Pest',
				'color' => '#ff780d',
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
				'type' => 'Pest',
				'color' => '#e90040',
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
				'id' => 4,
				'name' => 'Typhlodromus',
				'type' => 'Predatory',
				'color' => '#041b5f',
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
		echo "m140821_112133_update_mite migration down.\n";
		$this->updateTablePrefix();
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