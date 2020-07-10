<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
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
			'nama_jabatan'	=> [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'nama_singkat'	=> [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'jml_karyawan'	=> [
				'type'	=> 'int',
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
		$this->forge->createTable('jabatan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('jabatan');
	}
}
