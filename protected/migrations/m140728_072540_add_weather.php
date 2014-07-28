<?php

class m140728_072540_add_weather extends CDbMigration
{
	public $tableNameWeather = 'weather';
	public $tableNameLocation = 'location';
	
	public function updateTablePrefix()
	{
		$this->tableNameWeather = $this->dbConnection->tablePrefix . $this->tableNameWeather;
		$this->tableNameLocation = $this->dbConnection->tablePrefix . $this->tableNameLocation;
	}
	
	public function up()
	{
		$this->updateTablePrefix();
		// excute import old table 
		$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_weather.sql'));
		//rename table with prefix
		$this->renameTable('weather',$this->tableNameWeather);
		
		//rename column
		$this->renameColumn($this->tableNameWeather,'weather_date','date');
		$this->renameColumn($this->tableNameWeather,'weather_min','min');
		$this->renameColumn($this->tableNameWeather,'weather_max','max');
		
		// Common fields, should appear in all tabl**
		$this->addColumn($this->tableNameWeather,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
		$this->addColumn($this->tableNameWeather,'ordering', 'integer NULL COMMENT "sorting weight"');
		$this->addColumn($this->tableNameWeather,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameWeather,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
		$this->addColumn($this->tableNameWeather,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
		$this->addColumn($this->tableNameWeather,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
		$this->addColumn($this->tableNameWeather,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
		
		// Drop old ForeignKey
		$this->dropForeignKey($this->tableNameWeather.'_ibfk_1',$this->tableNameWeather);
		
		// Added new ForeignKey
		$this->addForeignKey($this->tableNameWeather.'_ibfk_1', $this->tableNameWeather,'location_id', $this->tableNameLocation, 'id','CASCADE','CASCADE');

		return true;
	}

	public function down()
	{
		echo "m140728_072540_add_weather migration down.\n";
		$this->updateTablePrefix();
		$this->dropTable($this->tableNameWeather);
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