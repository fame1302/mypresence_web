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
				'autoincrement' => true
			],
			'kode'	=> [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'status'	=> [
				'type'	=> 'varchar',
				'constraint' => 255,

			],
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
