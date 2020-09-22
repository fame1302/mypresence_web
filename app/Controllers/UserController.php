<?php

namespace App\Controllers;

use App\Libraries;
use App\Models\KaryawanModel;
use App\Models\UserModel;
use CodeIgniter\Database\MySQLi\Builder;

class UserController extends BaseController
{

    protected $karyawan;
    public function __construct()
    {
        $this->karyawan = new KaryawanModel();
    }

    public function index()
    {
        // $data = [
        //     'title' => 'My Presence - Login',
        //     'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

        // ];
        // dd(session()->user_data);
        return view('welcome_message');
    }
    public function view_login()
    {
        if (isset(session()->user_data)) {
            return redirect()->to(base_url() . '/admin');
        }
        $data = [
            'title' => 'My Presence - Login',
            'validation' => \Config\Services::validation()
        ];
        // dd(session()->user_data);
        return view('login', $data);
    }

    public function login()
    {
        // dd("test");
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
            return redirect()->to(base_url() . base_url() . '/login')->withInput()->with('validation', $validation);
            dd($validation);
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
            return redirect()->to(base_url() . '/login')->withInput()->with('error', $error);
        }

        $user = [
            'logged_in' => true,
            'username' => $this->request->getPost('username'),
            'level' => $userModel->getUser($this->request->getPost('username'))['level']
        ];
        // dd($user);
        session()->set('user_data', $user);
        return redirect()->to(base_url() . '/admin');


        // return redirect()->to(base_url(). '/login')->with('error', $error);

        # code...
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url() . '/login');
        # code...
    }
    //--------------------------------------------------------------------

}
