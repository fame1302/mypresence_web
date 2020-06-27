<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id'	=>[
				'type' => 'INT',
				'unsigned' => true,
				'autoincrement' =>true
			],
			'nama_jabatan'	=>[
				'type' => 'varchar',
				'constraint' =>255,
			],
			'jml_karyawan'	=>[
				'type'	=>'int',
			],
		]);
		$this->forge->addKey('id',true);
		$this->forge->createTable('jabatan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('jabatan');

	}
}
