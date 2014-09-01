<?php

class m140820_115905_alter_grower extends CDbMigration
{
	
	public $tableNameGrower = 'grower';
	
	public function updateTablePrefix()
	{
		$this->tableNameGrower = $this->dbConnection->tablePrefix . $this->tableNameGrower;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		
		$this->addColumn($this->tableNameGrower,'contact_name', 'VARCHAR(100) NULL AFTER salt');
		$this->addColumn($this->tableNameGrower,'address', 'VARCHAR(255) NULL AFTER contact_name');
		$this->addColumn($this->tableNameGrower,'suburb', 'VARCHAR(50) AFTER address');
		$this->addColumn($this->tableNameGrower,'postcode', 'VARCHAR(5) AFTER suburb');
		$this->addColumn($this->tableNameGrower,'state', "ENUM('ACT','NSW','NT','QLD','SA','TAS','VIC','WA') AFTER postcode");
		$this->addColumn($this->tableNameGrower,'phone', 'VARCHAR(20) AFTER state');
		$this->addColumn($this->tableNameGrower,'mobile', 'VARCHAR(20) AFTER state');
		$this->addColumn($this->tableNameGrower,'avatar', 'varchar(255) NULL AFTER mobile');
		$this->addColumn($this->tableNameGrower,'weekly_interval',"ENUM('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NULL AFTER reporting");
		
		return true;
	}

	public function down()
	{
		$this->updateTablePrefix();
		
		$this->dropColumn($this->tableNameGrower,'contact_name');
		$this->dropColumn($this->tableNameGrower,'address');
		$this->dropColumn($this->tableNameGrower,'suburb');
		$this->dropColumn($this->tableNameGrower,'postcode');
		$this->dropColumn($this->tableNameGrower,'state');
		$this->dropColumn($this->tableNameGrower,'phone');
		$this->dropColumn($this->tableNameGrower,'mobile');
		$this->dropColumn($this->tableNameGrower,'avatar');
		
		echo "m140820_115905_alter_grower migration down.\n";
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