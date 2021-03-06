<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\MySQLi\Forge;

class Users extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id'	=> [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'username'	=> [
				'type' => 'varchar',
				'constraint' => 255,
				'unique' => true
			],
			'password'	=> [
				'type'	=> 'varchar',
				'constraint' => 255
			],
			'email'	=> [
				'type'	=> 'varchar',
				'constraint' => 255,
				'unique' => true
			],
			'level'	=> [
				'type'	=> 'INT',
				'constraint'	=> 1
			],
			'created_at'	=> [
				'type'	=> 'datetime',
				'null' => true
			],
			'updated_at'	=> [
				'type'	=> 'datetime',
				'null' => true

			],
			'deleted_at'	=> [
				'type'	=> 'datetime',
				'null' => true

			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('users');
	}
}
