<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\JabatanModel;
use App\Models\UserModel;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_user', 'nama', 'jenis_kelamin', 'alamat', 'id_jabatan', 'foto'];


    public function getKaryawan($username = false)
    {
        if ($username == false) {
            $jab = new JabatanModel();
            $new = [];
            $num = 0;
            foreach ($this->findAll() as $key) {
                $jabatan = $jab->where(['id' => $key['id_jabatan']])->first();
                $new[$num] = $key;
                // array_push($new[$num], ['jabatan' => 'tes']);
                $new[$num]['jabatan'] = $jabatan['nama_jabatan'];
                // $new[$num]['username'] = $jabatan['nama_jabatan'];

                // $new[$num] = array_push($key, ['jabatan' => $jabatan]);
                $num++;
            }

            return $new;
        }
        $user = new UserModel();
        $id = $user->where(['username' => $username])->first()['id'];
        return $this->where(['id_user' => $id])->first();
        # code...
    }

    function getKaryawanById($id)
    {
        $karyawan = $this->where(['id' => $id])->first();
        $user_id = $karyawan['id_user'];
        $userModel = new UserModel();
        $user = $userModel->where(['id' => $user_id])->first();
        $karyawan['username'] = $user['username'];
        $karyawan['password'] = $user['password'];
        $karyawan['email'] = $user['email'];
        $karyawan['level'] = $user['level'];
        return $karyawan;
    }
}
