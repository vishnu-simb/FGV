<?php

class m140821_072025_add_mite_monitor extends CDbMigration
{
	
	public $tableNameMiteMonitor = 'mite_monitor';
	public $tableNameBlock = 'block';
	public $tableNameMites = 'mite';
	
	public function updateTablePrefix()
	{
		$this->tableNameMiteMonitor = $this->dbConnection->tablePrefix . $this->tableNameMiteMonitor;
		$this->tableNameBlock = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNameMites = $this->dbConnection->tablePrefix . $this->tableNameMites;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		
		$this->createTable(
				$this->tableNameMiteMonitor,
				array(
						'id' => 'BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT',
						'mite_id' => 'int(11) NOT NULL',
						'block_id' => 'int(11) NOT NULL' ,
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
		
		// Mite Monitoring Pk
		$this->createIndex(
				$this->tableNameMiteMonitor.'_mite_idx',
				$this->tableNameMiteMonitor,
				'mite_id', false
		);
		
		$this->createIndex(
				$this->tableNameMiteMonitor.'_block_idx',
				$this->tableNameMiteMonitor,
				'block_id', false
		);
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameMiteMonitor.'_ibfk_1', $this->tableNameMiteMonitor,'mite_id', $this->tableNameMites, 'id','CASCADE','CASCADE');
		$this->addForeignKey($this->tableNameMiteMonitor.'_ibfk_2', $this->tableNameMiteMonitor,'block_id', $this->tableNameBlock, 'id','CASCADE','CASCADE');
		
		true;
	}

	public function down()
	{
		echo "m140821_072025_add_mite_monitor migration down.\n";
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