<?php

use yii\db\Schema;
use yii\db\Migration;

class m181127_165804_Mass extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable('{{%band}}',[
            'id'=> $this->primaryKey(11),
            'band_name'=> $this->string(255)->notNull(),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('name','{{%band}}',['band_name'],true);

        $this->createTable('{{%concert}}',[
            'id'=> $this->primaryKey(11),
            'date'=> $this->date()->notNull(),
            'band_id'=> $this->integer(11)->notNull(),
            'location'=> $this->string(255)->notNull(),
            'country_id'=> $this->smallInteger(6)->notNull(),
            'description'=> $this->text()->notNull(),
            'has_photo'=> $this->tinyint(4)->notNull()->defaultValue(0),
            'photo_file_path'=> $this->string(50)->null()->defaultValue(null),
            'created_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
            'updated_at'=> $this->datetime()->notNull()->defaultExpression("CURRENT_TIMESTAMP"),
        ], $tableOptions);

        $this->createIndex('band_id','{{%concert}}',['band_id'],false);
        $this->createIndex('country_id','{{%concert}}',['country_id'],false);

        $this->createTable('{{%country}}',[
            'id'=> $this->primaryKey(6),
            'country_name'=> $this->string(100)->notNull(),
            'iso_abbr'=> $this->string(2)->notNull(),
            'un_abbr'=> $this->string(3)->notNull(),
            'dialing_code'=> $this->string(20)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%profile}}',[
            'user_id'=> $this->primaryKey(11),
            'name'=> $this->string(255)->null()->defaultValue(null),
            'public_email'=> $this->string(255)->null()->defaultValue(null),
            'gravatar_email'=> $this->string(255)->null()->defaultValue(null),
            'gravatar_id'=> $this->string(32)->null()->defaultValue(null),
            'location'=> $this->string(255)->null()->defaultValue(null),
            'website'=> $this->string(255)->null()->defaultValue(null),
            'bio'=> $this->text()->null()->defaultValue(null),
            'timezone'=> $this->string(40)->null()->defaultValue(null),
        ], $tableOptions);


        $this->createTable('{{%social_account}}',[
            'id'=> $this->primaryKey(11),
            'user_id'=> $this->integer(11)->null()->defaultValue(null),
            'provider'=> $this->string(255)->notNull(),
            'client_id'=> $this->string(255)->notNull(),
            'data'=> $this->text()->null()->defaultValue(null),
            'code'=> $this->string(32)->null()->defaultValue(null),
            'created_at'=> $this->integer(11)->null()->defaultValue(null),
            'email'=> $this->string(255)->null()->defaultValue(null),
            'username'=> $this->string(255)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('account_unique','{{%social_account}}',['provider','client_id'],true);
        $this->createIndex('account_unique_code','{{%social_account}}',['code'],true);
        $this->createIndex('fk_user_account','{{%social_account}}',['user_id'],false);

        $this->createTable('{{%token}}',[
            'user_id'=> $this->integer(11)->notNull(),
            'code'=> $this->string(32)->notNull(),
            'created_at'=> $this->integer(11)->notNull(),
            'type'=> $this->smallInteger(6)->notNull(),
        ], $tableOptions);

        $this->createIndex('token_unique','{{%token}}',['user_id','code','type'],true);
        $this->addPrimaryKey('pk_on_token','{{%token}}',['user_id','code','type']);

        $this->createTable('{{%user}}',[
            'id'=> $this->primaryKey(11),
            'username'=> $this->string(255)->notNull(),
            'email'=> $this->string(255)->notNull(),
            'password_hash'=> $this->string(60)->notNull(),
            'auth_key'=> $this->string(32)->notNull(),
            'confirmed_at'=> $this->integer(11)->null()->defaultValue(null),
            'unconfirmed_email'=> $this->string(255)->null()->defaultValue(null),
            'blocked_at'=> $this->integer(11)->null()->defaultValue(null),
            'registration_ip'=> $this->string(45)->null()->defaultValue(null),
            'created_at'=> $this->integer(11)->notNull(),
            'updated_at'=> $this->integer(11)->notNull(),
            'flags'=> $this->integer(11)->notNull()->defaultValue(0),
            'last_login_at'=> $this->integer(11)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('user_unique_username','{{%user}}',['username'],true);
        $this->createIndex('user_unique_email','{{%user}}',['email'],true);
        $this->addForeignKey(
            'fk_concert_band_id',
            '{{%concert}}', 'band_id',
            '{{%band}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_concert_country_id',
            '{{%concert}}', 'country_id',
            '{{%country}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_profile_user_id',
            '{{%profile}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_social_account_user_id',
            '{{%social_account}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'fk_token_user_id',
            '{{%token}}', 'user_id',
            '{{%user}}', 'id',
            'CASCADE', 'CASCADE'
        );
    }

    public function safeDown()
    {
            $this->dropForeignKey('fk_concert_band_id', '{{%concert}}');
            $this->dropForeignKey('fk_concert_country_id', '{{%concert}}');
            $this->dropForeignKey('fk_profile_user_id', '{{%profile}}');
            $this->dropForeignKey('fk_social_account_user_id', '{{%social_account}}');
            $this->dropForeignKey('fk_token_user_id', '{{%token}}');
            $this->dropTable('{{%band}}');
            $this->dropTable('{{%concert}}');
            $this->dropTable('{{%country}}');
            $this->dropTable('{{%profile}}');
            $this->dropTable('{{%social_account}}');
            $this->dropPrimaryKey('pk_on_token','{{%token}}');
            $this->dropTable('{{%token}}');
            $this->dropTable('{{%user}}');
    }
}
