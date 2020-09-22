<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    // protected $modelName = 'App'
    protected $format = 'json';
    protected $users;


    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        $data = $this->users->findAll();
        if ($data == null) {
            return $this->failNotFound("user tidak ditemukan!");
        }
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->users->find($id);
        if ($data == null) {
            return $this->failNotFound("user tidak ditemukan!");
        }
        return $this->respond($data);
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->users->where(['username' => $username, 'password' => $password])->first();
        if ($user == null) {
            return $this->fail("username atau password salah!");
        }
        $user['login'] = true;
        return $this->respond($user);
    }


    //--------------------------------------------------------------------

}
