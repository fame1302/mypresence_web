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
				'autoincrement' => true
			],
			'id_profil'	=> [
				'type' => 'int',
				'unsigned' => true,
			],
			'tanggal'	=> [
				'type'	=> 'datetime'
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addForeignKey('id_profil', 'profil_jadwal', 'id');
		$this->forge->createTable('jadwal');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('jadwal');
	}
}
