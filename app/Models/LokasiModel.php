<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'lokasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_lokasi', 'alamat', 'lat', 'long'];
    protected $useSoftDeletes = true;
}
