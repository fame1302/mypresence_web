<?php

namespace App\Database\Seeds;

class jabatan extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Desa',
                'nama_singkat'    => 'Kades',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Sekretaris Desa',
                'nama_singkat'    => 'Sekdes',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Urusan Keuangan',
                'nama_singkat'    => 'Kaur Keuangan',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Urusan Perencanaan',
                'nama_singkat'    => 'Kaur Perencanaan',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Urusan Tata Usaha dan Umum',
                'nama_singkat'    => 'Kaur TU',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Seksi Pemerintahan',
                'nama_singkat'    => 'Kasi Pemerintahan',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Seksi Kesejahteraan',
                'nama_singkat'    => 'Kasi Kesejahteraan',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Seksi Pelayanan',
                'nama_singkat'    => 'Kasi Pelayanan',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Dusun I',
                'nama_singkat'    => 'Kadus I',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Dusun II',
                'nama_singkat'    => 'Kadus II',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Dusun III',
                'nama_singkat'    => 'Kadus III',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Kepala Dusun IV',
                'nama_singkat'    => 'Kadus IV',
                'jml_karyawan'    => '1',
            ],
            [
                'id' => '',
                'nama_jabatan'    => 'Operator',
                'nama_singkat'    => 'Operator',
                'jml_karyawan'    => '2',
            ],
        ];

        foreach ($data as $test) {
            $this->db->table('jabatan')->insert($test);
        }
    }
}
