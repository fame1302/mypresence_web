<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jadwal extends Migration
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
			'id_profil'	=> [
				'type' => 'int',
				'unsigned' => true,
			],
			'tanggal'	=> [
				'type'	=> 'date'
			],
			'id_lokasi'	=> [
				'type'	=> 'int',
				'unsigned'	=> true,
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
		$this->forge->addForeignKey('id_profil', 'profil_jadwal', 'id');
		$this->forge->addForeignKey('id_lokasi', 'lokasi', 'id');
		$this->forge->createTable('jadwal');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('jadwal');
	}
}
