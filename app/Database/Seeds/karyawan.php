<?php

namespace App\Database\Seeds;

class karyawan extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'id' => '',
            'id_user' => 1,
            'nama'    => 'Fahmi Pamungkas',
            'jenis_kelamin'    => 'l',
            'alamat'    => 'Kp. Peundeuy rt.01/09',
            'id_jabatan'    => 13,
            'foto'    => '',
        ];

        // Using Query Builder
        $this->db->table('karyawan')->insert($data);
    }
}
