<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_profil', 'tanggal', 'lokasi'];
}
