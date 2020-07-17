<?php

namespace App\Controllers;

use App\Database\Migrations\Karyawan;
use App\Libraries;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;
use App\Models\ProfilJadwalModel;

class TestVarController extends BaseController
{
    public function index()
    {
        $var = new ProfilJadwalModel();
        dd($var->clearDefault());
        # code...
    }
}
