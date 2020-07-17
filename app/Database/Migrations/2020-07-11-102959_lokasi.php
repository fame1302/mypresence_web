<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lokasi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'nama_lokasi'	=> [
				'type' => 'varchar',
				'constraint' => 255
			],
			'alamat'	=> [
				'type' => 'varchar',
				'constraint' => 255
			],
			'lat'	=> [
				'type'	=> 'double',
				// 'constraint'	=> 255
			],
			'long'	=> [
				'type'	=> 'double',
			],
			'default'	=> [
				'type'	=> 'int',
				'constraint' => 1,
				'null' => true
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
		$this->forge->createTable('lokasi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('lokasi');
	}
}
