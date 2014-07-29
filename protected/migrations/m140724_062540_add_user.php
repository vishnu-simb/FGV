<?php

class m140724_062540_add_user extends CDbMigration
{
    public $tableNameUser = 'users';
    public $tableNameUserRole = 'user_roles';
    public $tableNameUserUserRoleMap = 'user_user_role_maps';

    public function updateTablePrefix()
    {
        $this->tableNameUser = $this->dbConnection->tablePrefix . $this->tableNameUser;
        $this->tableNameUserRole = $this->dbConnection->tablePrefix . $this->tableNameUserRole;
        $this->tableNameUserUserRoleMap = $this->dbConnection->tablePrefix . $this->tableNameUserUserRoleMap;
    }

    public function up()
    {
        $this->updateTablePrefix();

        $this->createTable(
            $this->tableNameUser,
            array(
                'id' => 'BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT',
                'username' => 'varchar(32) NOT NULL COMMENT "Username to login"',
                'email' => 'varchar(255) NOT NULL COMMENT "Email of the user"',
                'display_name' => 'varchar(255) NOT NULL COMMENT "Name to be displayed in public"',
                'slug' => 'varchar(255) NOT NULL COMMENT "URL alias for the item"',
                'password' => 'varchar(64) NOT NULL COMMENT "Encoded password of the user"',
                'salt' => 'varchar(8) NOT NULL COMMENT "A token used to encode the password"',
                'is_super_admin' => 'TINYINT(1) NULL DEFAULT 0 COMMENT "User has the supreme permission or not (including add Administrator)"',

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

        $this->createTable(
            $this->tableNameUserRole,
            array(
                'id' => 'BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT',
                'name' => 'varchar(255) NOT NULL COMMENT "Name of the item"',
                'slug' => 'varchar(255) NOT NULL COMMENT "URL alias for the item"',
                'parent_id' => 'BIGINT NULL DEFAULT 0 COMMENT "ID of parent role"',
                'level' => 'TINYINT NULL DEFAULT 0 COMMENT "Level of this role"',
                'permission_weight' => 'BIGINT NULL DEFAULT 0 COMMENT "The weight for this role"',
                'backend_accessible' => 'TINYINT(1) NULL DEFAULT 0 COMMENT "Allow user to login to backend or not"',

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

        $this->createTable(
            $this->tableNameUserUserRoleMap,
            array(
                'user_id' => 'BIGINT NOT NULL COMMENT "id of user who belongs to user role attached"',
                'user_role_id' => 'BIGINT NOT NULL COMMENT "id of user role the user belongs to"',

                'ordering' => 'integer NULL COMMENT "sorting weight"',
            )
        );

        // User
        $this->createIndex(
            $this->tableNameUser.'_username_idx',
            $this->tableNameUser,
            'username', false
        );
        $this->createIndex(
            $this->tableNameUser.'_email_idx',
            $this->tableNameUser,
            'email', false
        );
        $this->createIndex(
            $this->tableNameUser.'_ordering_idx',
            $this->tableNameUser,
            'ordering', false
        );
        $this->createIndex(
            $this->tableNameUser.'_created_at_idx',
            $this->tableNameUser,
            'created_at', false
        );
        $this->createIndex(
            $this->tableNameUser.'_status_idx',
            $this->tableNameUser,
            'status', false
        );
        $this->createIndex(
            $this->tableNameUser.'_is_deleted_idx',
            $this->tableNameUser,
            'is_deleted', false
        );

        // User Role
        $this->createIndex(
            $this->tableNameUserRole.'_parent_id_idx',
            $this->tableNameUserRole,
            'parent_id', false
        );
        $this->createIndex(
            $this->tableNameUserRole.'_permission_weight_idx',
            $this->tableNameUserRole,
            'permission_weight', false
        );
        $this->createIndex(
            $this->tableNameUserRole.'_ordering_idx',
            $this->tableNameUserRole,
            'ordering', false
        );
        $this->createIndex(
            $this->tableNameUserRole.'_created_at_idx',
            $this->tableNameUserRole,
            'created_at', false
        );
        $this->createIndex(
            $this->tableNameUserRole.'_status_idx',
            $this->tableNameUserRole,
            'status', false
        );
        $this->createIndex(
            $this->tableNameUserRole.'_is_deleted_idx',
            $this->tableNameUserRole,
            'is_deleted', false
        );

        // User Role Map
        $this->createIndex(
            $this->tableNameUserUserRoleMap.'_user_id_idx',
            $this->tableNameUserUserRoleMap,
            'user_id', false
        );
        $this->createIndex(
            $this->tableNameUserUserRoleMap.'_user_role_id_idx',
            $this->tableNameUserUserRoleMap,
            'user_role_id', false
        );
        $this->createIndex(
            $this->tableNameUserUserRoleMap.'_ordering_idx',
            $this->tableNameUserUserRoleMap,
            'ordering', false
        );

        $this->insert($this->tableNameUser, array(
                'id' => 1,
                'username' => 'admin',
                'email' => 'npbtrac@yahoo.com',
                'display_name' => 'Administrator',
                'slug' => 'admin',
                'password' => hash('md5','fgvadmin'),
                'salt' => 'fgv',
                'is_super_admin' => 1,

                // Common fields, should appear in all tables
                'creator_id' => 0,
                'ordering' => 0,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s'),
                'status' => AppConst::USER_ACTIVE,
                'is_deleted' => AppConst::DELETED_FALSE,
                'params' => null,
            ));

        $this->insert($this->tableNameUserRole, array(
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'parent_id' => 0,
                'level' => 0,
                'permission_weight' => 999999999,
                'backend_accessible' => 1,

                // Common fields, should appear in all tables
                'creator_id' => 0,
                'ordering' => 0,
                'created_at' => gmdate('Y-m-d H:i:s'),
                'updated_at' => gmdate('Y-m-d H:i:s'),
                'status' => AppConst::STATUS_ACTIVE,
                'is_deleted' => AppConst::DELETED_FALSE,
                'params' => null,
            ));
        
        $this->insert($this->tableNameUserRole, array(
        		'id' => 2,
        		'name' => 'Scout',
        		'slug' => 'scout',
        		'parent_id' => 0,
        		'level' => 0,
        		'permission_weight' => 999999999,
        		'backend_accessible' => 0,
        
        		// Common fields, should appear in all tables
        		'creator_id' => 0,
        		'ordering' => 0,
        		'created_at' => gmdate('Y-m-d H:i:s'),
        		'updated_at' => gmdate('Y-m-d H:i:s'),
        		'status' => AppConst::STATUS_ACTIVE,
        		'is_deleted' => AppConst::DELETED_FALSE,
        		'params' => null,
        ));
        
        $this->insert($this->tableNameUserUserRoleMap, array(
                'user_id' => 1,
                'user_role_id' => 1,
                'ordering' => 0,
            ));

        return true;
	}

	public function down()
	{
		echo "m140724_062540_add_user migration down.\n";
        $this->updateTablePrefix();
        $this->dropTable($this->tableNameUserUserRoleMap);
        $this->dropTable($this->tableNameUserRole);
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