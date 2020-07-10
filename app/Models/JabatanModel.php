<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KaryawanModel;

class JabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $useTimestamps = true;

    public function getJabatan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
    }

    public function getAvailableJabatan()
    {

        $karyawan = new KaryawanModel();
        $jab_list = $this->findAll();
        // $data = null;
        $num = 0;
        foreach ($jab_list as $jab) {
            $jml_kar = count($karyawan->where(['id_jabatan' => $jab['id']])->findAll());
            if ($jml_kar < $jab['jml_karyawan']) {
                $data[$num] = $jab;
            }
            $num++;
        }

        return $data;
        # code...
    }
}
