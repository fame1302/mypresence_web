<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilJadwalModel extends Model
{
    protected $table = 'profil_jadwal';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_profil', 'jam_masuk', 'jam_pulang', 'durasi', 'keterangan'];
    protected $useSoftDeletes = true;
}
