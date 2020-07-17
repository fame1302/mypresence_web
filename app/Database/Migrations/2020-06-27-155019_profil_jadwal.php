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
				'auto_increment' => true
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
		$this->forge->createTable('profil_jadwal');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('profil_jadwal');

		//
	}
}
