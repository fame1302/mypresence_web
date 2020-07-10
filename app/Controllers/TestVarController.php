<?php

namespace App\Controllers;

use App\Database\Migrations\Karyawan;
use App\Libraries;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;

class TestVarController extends BaseController
{
    public function index()
    {
        $var = new KaryawanModel();
        dd($var->getKaryawan());
        # code...
    }
}
