<?php

class m140724_062540_add_user extends CDbMigration
{
    public $tableNameUser = 'users';

    public function updateTablePrefix()
    {
        $this->tableNameUser = $this->dbConnection->tablePrefix . $this->tableNameUser;

    }

    public function up()
    {
    	$this->updateTablePrefix();
    	// excute import old table
    	$this->execute(file_get_contents(Yii::app()->basePath.'/data/old_admin.sql'));
    	//rename table with prefix
    	$this->renameTable('admin',$this->tableNameUser);
    
    	//rename column
    	$this->renameColumn($this->tableNameUser,'admin_id','id');
    	$this->renameColumn($this->tableNameUser,'admin_username','username');
    	$this->renameColumn($this->tableNameUser,'admin_password','password');
    	$this->renameColumn($this->tableNameUser,'admin_type','type');
    
    	// Common fields, should appear in all table
    	$this->addColumn($this->tableNameUser,'salt', 'varchar(8) NOT NULL COMMENT "A token used to encode the password"');
    	$this->addColumn($this->tableNameUser,'creator_id', 'BIGINT NULL COMMENT "id of user who create this item"');
    	$this->addColumn($this->tableNameUser,'ordering', 'integer NULL COMMENT "sorting weight"');
    	$this->addColumn($this->tableNameUser,'created_at', 'datetime NULL COMMENT "date, time that the record created"');
    	$this->addColumn($this->tableNameUser,'updated_at', 'datetime NULL COMMENT "date, time that the record created"');
    	$this->addColumn($this->tableNameUser,'status', 'TINYINT(1) NOT NULL DEFAULT 1 COMMENT "item status (published, draft, in-trash...)"');
    	$this->addColumn($this->tableNameUser,'is_deleted', 'TINYINT(1) NOT NULL DEFAULT 0 COMMENT "item is deleted or not"');
    	$this->addColumn($this->tableNameUser,'params', 'text NULL COMMENT "json string, to store some needed values for this item"');
    	
    	$this->insert($this->tableNameUser, array(
    			'id' => 1,
    			'username' => 'admin',
    			'password' => hash('md5','fgvadmin'),
    			'salt' => 'fgv',
    			'type' => 'admin',
    	
    			// Common fields, should appear in all tables
    			'creator_id' => 0,
    			'ordering' => 0,
    			'created_at' => gmdate('Y-m-d H:i:s'),
    			'updated_at' => gmdate('Y-m-d H:i:s'),
    			'status' => AppConst::USER_ACTIVE,
    			'is_deleted' => AppConst::DELETED_FALSE,
    			'params' => null,
    	));
    	 
    	$this->insert($this->tableNameUser, array(
    			'id' => 4,
    			'username' => 'scout',
    			'password' => hash('md5','fgvscout'),
    			'salt' => 'fgv',
    			'type' => 'scout',
    			 
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
		echo "m140724_062540_add_user migration down.\n";
        $this->updateTablePrefix();
        $this->dropTable($this->tableNameUser);
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