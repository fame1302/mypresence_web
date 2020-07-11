<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'email', 'level'];

    public function getUser($username = false)
    {
        return $this->where(['username' => $username])->first();
    }
}
