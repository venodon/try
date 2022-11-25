<?php

namespace Fuel\Migrations;

class Create_categories
{
	public function up()
	{
//		\DBUtil::create_table('categories', array(
//			'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => '11'),
//			'title' => array('constraint' => '255', 'null' => false, 'type' => 'varchar'),
//			'sort' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
//			'status' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
//			'created_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
//			'updated_at' => array('constraint' => '11', 'null' => false, 'type' => 'int'),
//		), array('id'));
//        \DbUtil::add_fields('posts',['category_id' => ['type' => 'int']]);
        \DbUtil::add_foreign_key('posts',[
            'key' => 'category_id',
            'reference' => array(
                'table' => 'categories',
                'column' => 'id',
            ),]);
	}

	public function down()
	{
		\DBUtil::drop_foreign_key('posts');
		\DBUtil::drop_fields('posts',['category_id']);
		\DBUtil::drop_table('categories');
	}
}