<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use PHPUnit\Framework\Constraint\Constraint;

class ProfilJadwal extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
				'type' => 'INT',
				'unsigned' => true,
				'autoincrement' => true
			],
			'nama_profil'	=> [
				'type' => 'varchar',
				'constraint' => 255
			],
			'jam_masuk'	=> [
				'type'	=> 'time'
			],
			'jam_pulang'	=> [
				'type'	=> 'time'
			],
			'durasi'	=> [
				'type'	=> 'int',
				'constraint' => 3
			],
			'keterangan'	=> [
				'type'	=> 'varchar',
				'constraint' => 255
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('profil_jadwal');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('profil_jadwal');

		//
	}
}
