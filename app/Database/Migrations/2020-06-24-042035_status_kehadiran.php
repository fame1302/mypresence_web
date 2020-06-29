<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusKehadiran extends Migration
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
			'kode'	=> [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'status'	=> [
				'type'	=> 'varchar',
				'constraint' => 255,

			],
			'created_at'	=> [
				'type'	=> 'datetime',
				'null' => true

			],
			'modified_at'	=> [
				'type'	=> 'datetime',
				'null' => true

			],
			'deleted_at'	=> [
				'type'	=> 'datetime',
				'null' => true

			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('status_kehadiran');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('status_kehadiran');
	}
}
