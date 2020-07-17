<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'lokasi';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_lokasi', 'alamat', 'lat', 'long', 'default'];
    protected $useSoftDeletes = true;

    public function clearDefault()
    {
        $clr = $this->where(['default' == 1])->findall();
        foreach ($clr as $key) {
            $this->update($key['id'], ['default' => null]);
        }
    }
}
