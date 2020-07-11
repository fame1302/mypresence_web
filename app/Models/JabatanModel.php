<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KaryawanModel;

class JabatanModel extends Model
{
    protected $table = 'jabatan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_jabatan', 'nama_singkat', 'jml_karyawan'];


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

    public function getAvailableJabatanOnEdit($id)
    {
        $karyawan = new KaryawanModel();
        $jab_list = $this->findAll();
        $id_jab = $karyawan->where(['id' => $id])->first()['id_jabatan'];
        $num = 0;
        foreach ($jab_list as $jab) {
            $jml_kar = count($karyawan->where(['id_jabatan' => $jab['id']])->findAll());
            if ($jml_kar < $jab['jml_karyawan']) {
                $id_list[$num] = $jab['id'];
            }
            $num++;
        }
        $id_list[$num] = $this->where(['id' => $id_jab])->first()['id'];
        $len = count($id_list);
        $k = 0;
        $list = array_unique($id_list);

        foreach ($list as $key) {
            $new[$k] = $this->where(['id' => $key])->first();
            $k++;
        }
        // for ($i = 0; $i < $len; $i++) {
        //     $ids = $data[$i]['id'];
        //     for ($j = 0; $j < $len; $j++) {
        //         $idd = $data[$j]['id'];
        //         if ($ids != $idd) {
        //             $new[$k] = $data[$i];
        //             $k++;
        //         }
        //     }
        // }
        return $new;
        # code...
    }
}
