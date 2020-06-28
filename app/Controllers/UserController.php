<?php

namespace App\Controllers;

use App\Libraries;
use App\Models\UserModel;
use CodeIgniter\Database\MySQLi\Builder;

class UserController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'My Presence - Login',
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function login()
    {
        $userModel = new UserModel();
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_not_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_not_unique' => '{field} tidak terdaftar!'
                ]
            ],

            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/login')->withInput()->with('validation', $validation);
            // dd($validation);
        };

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $query = $builder->getWhere([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ])->getResult();

        if (count($query) == 0) {
            $error = [
                'message' => 'password salah!'
            ];
            return redirect()->to('/login')->withInput()->with('error', $error);
        }

        $user = [
            'logged_in' => true,
            'username' => $this->request->getPost('username'),
            'level' => $userModel->getUser($this->request->getPost('username'))['level']
        ];
        // dd($user);
        return redirect()->to('/admin')->with('user_data', $user);


        // return redirect()->to('/login')->with('error', $error);

        # code...
    }

    //--------------------------------------------------------------------

}
