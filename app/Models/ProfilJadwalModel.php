<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilJadwalModel extends Model
{
    protected $table = 'profil_jadwal';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_profil', 'jam_masuk', 'jam_pulang', 'durasi', 'keterangan', 'default'];
    protected $useSoftDeletes = true;

    public function clearDefault()
    {
        $clr = $this->where(['default' == 1])->findall();
        foreach ($clr as $key) {
            $this->update($key['id'], ['default' => null]);
        }
    }
}
