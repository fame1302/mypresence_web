<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    // protected $useSoftDeletes = true;
    // protected $useTimestamps = true;

    public function getUser($username = false)
    {
        return $this->where(['username' => $username])->first();
        # code...
    }
}
