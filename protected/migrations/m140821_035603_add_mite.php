<?php

class m140821_035603_add_mite extends CDbMigration
{
	
	public $tableNameMite = 'mite';
	
	public function updateTablePrefix()
	{
		$this->tableNameMite = $this->dbConnection->tablePrefix . $this->tableNameMite;
	
	}

	public function up()
	{
		$this->updateTablePrefix();
		
		$this->createTable(
				$this->tableNameMite,
				array(
						'id' => 'int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT',
						'name' => 'varchar(100) NOT NULL COMMENT "name of pest mites and predators mites"',
						'type' => 'ENUM(\'Predatory\',\'Pest\') NOT NULL COMMENT "type of mites"',
						'color' => 'varchar(100) NOT NULL COMMENT "color of pest mites and predators mites"',
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
	
		// Pest Mites
		$this->createIndex(
				$this->tableNameMite.'_name_UNIQUE_idx',
				$this->tableNameMite,
				'name', false
		);
		
		return true;
	}

	public function down()
	{
		echo "m140821_035603_add_mite migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameMite);
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