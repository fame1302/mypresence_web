<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kehadiran extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'int',
				'unsigned' => true,
				'auto_increment' => true
			],
			'id_jadwal' => [
				'type' => 'int',
				'unsigned' => true,
			],
			'id_user' => [
				'type' => 'int',
				'unsigned' => true,
			],
			'id_status' => [
				'type' => 'int',
				'unsigned' => true,
			],
			'foto_masuk' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true
			],
			'foto_pulang' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true
			],
			'jam_masuk' => [
				'type' => 'time',
				'null' => true
			],
			'jam_pulang' => [
				'type' => 'time',
				'null' => true
			],
			'lokasi_masuk' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true
			],
			'lokasi_pulang' => [
				'type' => 'varchar',
				'constraint' => 255,
				'null' => true
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
		$this->forge->addForeignKey('id_jadwal', 'jadwal', 'id');
		$this->forge->addForeignKey('id_user', 'users', 'id');
		$this->forge->addForeignKey('id_status', 'status_kehadiran', 'id');
		$this->forge->createTable('kehadiran');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kehadiran');
		//
	}
}
