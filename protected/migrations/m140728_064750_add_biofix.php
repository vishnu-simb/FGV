<?php

class m140728_064750_add_biofix extends CDbMigration
{
	public $tableNameBiofix = 'biofix';
	public $tableNameBlock = 'block';
	public $tableNamePest = 'pest';
	
	public function updateTablePrefix()
	{
		$this->tableNameBiofix = $this->dbConnection->tablePrefix . $this->tableNameBiofix;
		$this->tableNameBlock  = $this->dbConnection->tablePrefix . $this->tableNameBlock;
		$this->tableNamePest  = $this->dbConnection->tablePrefix . $this->tableNamePest;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_biofix.sql'));
		//rename table with prefix
		$this->renameTable('biofix',$this->tableNameBiofix);
		
		
		//rename column
		$this->renameColumn($this->tableNameBiofix,'biofix_second_cohort','second_cohort');
		$this->renameColumn($this->tableNameBiofix,'biofix_date','date');
		
		// Common fields, should appear in all table
		$this->addColumn($this->tableNameBiofix,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameBiofix,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameBiofix,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameBiofix,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameBiofix,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameBiofix,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameBiofix,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameBiofix.'_ibfk_2',$this->tableNameBiofix);
		$this->dropForeignKey($this->tableNameBiofix.'_ibfk_3',$this->tableNameBiofix);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameBiofix.'_ibfk_3', $this->tableNameBiofix,'pest_id', $this->tableNamePest,'id','NO ACTION','NO ACTION');
		$this->addForeignKey($this->tableNameBiofix.'_ibfk_2', $this->tableNameBiofix,'block_id', $this->tableNameBlock, 'id','CASCADE','CASCADE');
		
		// Added {id} column and remove old index 
		$this->EXECUTE('ALTER TABLE '.$this->tableNameBiofix.' ADD COLUMN id INT(11) NOT NULL AUTO_INCREMENT FIRST,    CHANGE pest_id pest_id INT(10) UNSIGNED NOT NULL, CHANGE block_id block_id INT(11) NOT NULL, CHANGE second_cohort second_cohort ENUM("no","yes") CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT "no" NOT NULL, DROP PRIMARY KEY,     ADD PRIMARY KEY(id)');
		
		return true;
	}

	public function down()
	{
		echo "m140728_064750_add_biofix migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameBiofix);
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