<?php

class m140821_151233_add_monitor_check extends CDbMigration
{
	
	public $tableNameMiteMonitor = 'mite_monitor';
	public $tableNameMonitorCheck = 'monitor_check';
	
	public function updateTablePrefix()
	{
		$this->tableNameMiteMonitor = $this->dbConnection->tablePrefix . $this->tableNameMiteMonitor;
		$this->tableNameMonitorCheck = $this->dbConnection->tablePrefix . $this->tableNameMonitorCheck;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		
		$this->createTable(
				$this->tableNameMonitorCheck,
				array(
						'id' => 'BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT',
						'monitor_id' => 'BIGINT NOT NULL',
						'date' => 'DATE NOT NULL' ,
						'percentage' => 'float unsigned DEFAULT NULL',
						'average_number' => 'float unsigned DEFAULT NULL',
						'tc_comment' => 'text' ,
						// Common fields, should appear in all tables
						'creator_id' => 'BIGINT NULL COMMENT "id of user who create this item"',
						'ordering' => 'integer NULL COMMENT "sorting weight"',
						'created_at' => 'datetime NULL COMMENT "date, time that the record created"',
						'updated_at' => 'datetime NULL COMMENT "date, time that the record updated"',
						'status' => 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"',
						'is_deleted' => 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"',
						'params' => 'text NULL COMMENT "json string, to store some needed values for this item"',
				),
				'ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1'
		);
		
		$this->createIndex(
				$this->tableNameMonitorCheck.'_date_idx',
				$this->tableNameMonitorCheck,
				'monitor_id,date', true
		);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameMonitorCheck.'_ibfk_1', $this->tableNameMonitorCheck,'monitor_id', $this->tableNameMiteMonitor, 'id','CASCADE','CASCADE');
		
		return true;
	}

	public function down()
	{
		echo "m140821_151233_add_monitor_check migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameMiteMonitor);
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