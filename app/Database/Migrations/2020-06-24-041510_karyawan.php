<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Karyawan extends Migration
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
			'id_user'	=> [
				'type' => 'INT',
				'unsigned' => true,
			],
			'nama'	=> [
				'type' => 'varchar',
				'constraint' => 255,
			],
			'jenis_kelamin'	=> [
				'type'	=> 'varchar',
				'constraint' => 1
			],
			'alamat'	=> [
				'type'	=> 'varchar',
				'constraint'	=> 255
			],
			'id_jabatan'	=> [
				'type'	=> 'int',
				'unsigned' => true,
			],
			'foto'	=> [
				'type'	=> 'varchar',
				'constraint'	=> 255,
				'null'	=> true
			],

		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_user', 'users', 'id');
		$this->forge->addForeignKey('id_jabatan', 'jabatan', 'id');
		$this->forge->createTable('karyawan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('karyawan');
	}
}
