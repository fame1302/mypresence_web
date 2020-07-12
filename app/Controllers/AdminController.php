<?php

namespace App\Controllers;

use App\Libraries;
use App\Models\User;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;
use App\Models\JadwalModel;
use App\Models\ProfilJadwalModel;
use App\Models\UserModel;
use CodeIgniter\Validation\Validation as ValidationValidation;
use Config\Validation;

class AdminController extends BaseController
{
    /**
     * Class constructor.
     */
    protected $karyawan;
    protected $jabatan;
    protected $user;
    protected $profil_jadwal;
    protected $jadwal;

    public function __construct()
    {
        $this->karyawan = new KaryawanModel();
        $this->jabatan = new JabatanModel();
        $this->user = new UserModel();
        $this->profil_jadwal = new ProfilJadwalModel();
        $this->jadwal = new JadwalModel();
    }

    public function index()
    {

        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Dashboard',
                'sub_title' => 'Dashboard',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),
            'karyawan' => $this->karyawan->getKaryawan()
        ];

        // return view('admin/index', $data);
        return view('admin/index', $data);
    }

    public function jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jabatan',
                'sub_title' => 'Daftar Jabatan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),
            'jabatan' => $this->jabatan->getJabatan()
        ];

        // return view('admin/index', $data);
        return view('admin/jabatan', $data);
        # code...
    }

    public function tambah_jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jabatan',
                'sub_title' => 'Tambah Jabatan',
            ],
            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatan()
        ];

        return view('admin/tambah_jabatan', $data);

        # code...
    }

    function save_jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama jabatan tidak boleh kosong!',
                ]
            ],
            'nama_singkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama singkat tidak boleh kosong!',
                ]
            ],
            'jml_karyawan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'jumlah maksimal karyawan tidak boleh kosong!',
                    'integer' => 'jumlah maksimal karyawan harus berupa angka!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/tambah_jabatan')->withInput();
        }

        $this->jabatan->save([
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'nama_singkat' => $this->request->getVar('nama_singkat'),
            'jml_karyawan' => $this->request->getVar('jml_karyawan')
        ]);
        session()->setFlashdata('success', 'Jabatan berhasil ditambahkan!');
        return redirect()->to('/admin/tambah_jabatan');
    }

    public function delete_jabatan($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $use = $this->karyawan->where(['id_jabatan' => $id])->first();
        if ($use !== null) {
            session()->setFlashdata('error', 'Jabatan sudah ada yang mengisi!');
            return redirect()->to('/admin/jabatan');
        }

        $this->jabatan->delete($id);
        session()->setFlashdata('success', 'Jabatan berhasil dihapus!');
        return redirect()->to('/admin/jabatan');
    }

    public function edit_jabatan($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jabatan',
                'sub_title' => 'Edit Jabatan',
            ],
            'validation' => \Config\Services::validation(),
            'jabatan' => $this->jabatan->where(['id' => $id])->first()
        ];

        return view('admin/edit_jabatan', $data);
    }

    public function update_jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama jabatan tidak boleh kosong!',
                ]
            ],
            'nama_singkat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama singkat tidak boleh kosong!',
                ]
            ],
            'jml_karyawan' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'jumlah maksimal karyawan tidak boleh kosong!',
                    'integer' => 'jumlah maksimal karyawan harus berupa angka!',
                ]
            ],
        ])) {
            return redirect()->to('/admin/edit_jabatan/' . $id)->withInput();
        }

        $this->jabatan->save([
            'id' => $this->request->getVar('id'),
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'nama_singkat' => $this->request->getVar('nama_singkat'),
            'jml_karyawan' => $this->request->getVar('jml_karyawan')
        ]);
        session()->setFlashdata('success', 'Perubahan berhasil disimpan!');
        return redirect()->to('/admin/jabatan');
    }

    public function karyawan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        // $jabatan = new JabatanModel();
        // $karyawan = new KaryawanModel();
        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Daftar Karyawan',
            ],
            'karyawan' => $this->karyawan->getKaryawan()
        ];

        return view('admin/karyawan', $data);
    }

    public function tambah_karyawan($alpha = false)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Tambah Karyawan',
            ],
            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatan()
        ];

        return view('admin/tambah_karyawan', $data);
    }

    public function save_user()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }


        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[users.username]|alpha_numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah digunakan!',
                    'alpha_numeric' => '{field} hanya bisa berisi huruf dan angka tanpa spasi!',
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'min_length' => '{field} minimal 6 digit',
                ]
            ],
            'konfirmasi' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'matches' => '{field} password tidak sama!',
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'alpha_space' => '{field} harus berupa alfabet!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis kelamin tidak boleh kosong!',
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],

            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'file yang di upload bukan gambar',
                    'mime_in' => 'gambar tidak valid',
                ]
            ]

        ])) {
            return redirect()->to('/admin/tambah_karyawan')->withInput();
        }

        $filefoto = $this->request->getFile('foto');

        if ($filefoto->getError() === 4) {
            # code...
            $namafoto = '';
        } else {
            $namafoto = $filefoto->getRandomName();
            $filefoto->move('img/user_profile', $namafoto);
        }

        $this->user->save([
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'email' => $this->request->getVar('email'),
            'level' => $this->request->getVar('level')
        ]);
        $this->karyawan->save([
            'id_user' => $this->user->getInsertID(),
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jk'),
            'alamat' => $this->request->getVar('alamat'),
            'id_jabatan' => $this->request->getVar('jabatan'),
            'foto' => $namafoto,
        ]);
        // $karyawan = new KaryawanModel();
        session()->setFlashdata('success', 'Data berhasil di tambahkan!');
        return redirect()->to('/admin/tambah_karyawan');
    }

    public function delete_user($id)
    {

        $kar = $this->karyawan->find($id);
        if ($kar['foto'] !== "") {
            unlink('img/user_profile/' . $kar['foto']);
        }
        $this->karyawan->delete($id);
        $this->user->delete($kar['id_user']);


        session()->setFlashdata('success', 'Data berhasil di dihapus!');
        return redirect()->to('/admin/karyawan');
    }

    public function edit_user($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Edit Karyawan',
            ],
            'karyawan' => $this->karyawan->getKaryawanById($id),
            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatanOnEdit($id)
        ];

        return view('admin/edit_karyawan', $data);
    }

    public function update_user()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $id_karyawan = $this->request->getVar('id_karyawan');
        $kar = $this->karyawan->where(['id' => $id_karyawan])->first();
        $usr = $this->user->where(['id' => $kar['id_user']])->first();

        $username_rule = ($usr['username'] == $this->request->getVar('username')) ? 'required|alpha_numeric' : 'required|is_unique[users.username]|alpha_numeric';
        $email_rule = ($usr['username'] == $this->request->getVar('username')) ? 'required' : 'required|is_unique[users.username]';

        if (!$this->validate([
            'username' => [
                'rules' => $username_rule,
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah digunakan!',
                    'alpha_numeric' => '{field} hanya bisa berisi huruf dan angka tanpa spasi!',
                ]
            ],
            'email' => [
                'rules' => $email_rule,
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'min_length' => '{field} minimal 6 digit',
                ]
            ],
            'konfirmasi' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'matches' => '{field} password tidak sama!',
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                    'alpha_space' => '{field} harus berupa alfabet!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],
            'jk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis kelamin tidak boleh kosong!',
                ]
            ],
            'jabatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!',
                ]
            ],

            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'file yang di upload bukan gambar',
                    'mime_in' => 'gambar tidak valid',
                ]
            ]

        ])) {
            return redirect()->to('/admin/edit_karyawan/' . $id_karyawan)->withInput();
        }

        $filefoto = $this->request->getFile('foto');

        if ($filefoto->getError() === 4) {
            # code...
            $namafoto = $kar['foto'];
        } else {
            if ($kar['foto'] !== '') {
                # code...
                unlink('img/user_profile/' . $kar['foto']);
            }
            $namafoto = $filefoto->getRandomName();
            $filefoto->move('img/user_profile', $namafoto);
        }

        $this->user->save([
            'id' => $kar['id_user'],
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'email' => $this->request->getVar('email'),
            'level' => $this->request->getVar('level'),
        ]);
        $this->karyawan->save([
            'id' => $id_karyawan,
            'nama' => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jk'),
            'alamat' => $this->request->getVar('alamat'),
            'id_jabatan' => $this->request->getVar('jabatan'),
            'foto' => $namafoto,
        ]);
        // $karyawan = new KaryawanModel();
        session()->setFlashdata('success', 'Data berhasil di ubah!');
        return redirect()->to('/admin/karyawan');
    }


    public function profil_jadwal()
    {
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Profil Jadwal',
            ],
            'profil_jabatan' => $this->profil_jadwal->findAll()
        ];
        return view('admin/profil_jadwal', $data);
        # code...
    }

    public function add_profil_jadwal()
    {
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Profil Jadwal',
            ],
            'validation' => \Config\Services::validation(),
            'profil_jadwal' => $this->profil_jadwal->findAll()
        ];
        return view('admin/tambah_profil_jadwal', $data);
        # code...
    }

    public function save_profil_jadwal()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }
        // dd($this->request->getVar());
        if (!$this->validate([
            'nama_profil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama profil tidak boleh kosong!',
                ]
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jam masuk tidak boleh kosong!',
                ]
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jam pulang tidak boleh kosong!',
                ]
            ],
            'durasi' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'durasi tidak boleh kosong!',
                    'integer' => 'durasi harus berupa angka!',
                ]
            ],

        ])) {
            return redirect()->to('/admin/tambah_profil_jadwal')->withInput();
        }

        $this->profil_jadwal->save([
            'nama_profil' => $this->request->getVar('nama_profil'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
            'durasi' => $this->request->getVar('durasi'),
        ]);

        session()->setFlashdata('success', 'profil berhasil disimpan!');
        return redirect()->to('/admin/profil_jadwal');
    }

    public function delete_profil_jadwal($id)
    {

        $this->profil_jadwal->delete($id);

        session()->setFlashdata('success', 'Data berhasil di dihapus!');
        return redirect()->to('/admin/profil_jadwal');
    }

    public function edit_profil_jadwal($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Profil Jadwal',
            ],
            'validation' => \Config\Services::validation(),
            'profil_jadwal' => $this->profil_jadwal->find($id)
        ];

        return view('/admin/edit_profil_jadwal', $data);
    }

    public function update_profil_jadwal()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to('/login');
        }

        $id = $this->request->getVar('id');
        if (!$this->validate([
            'nama_profil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama profil tidak boleh kosong!',
                ]
            ],
            'jam_masuk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jam masuk tidak boleh kosong!',
                ]
            ],
            'jam_pulang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jam pulang tidak boleh kosong!',
                ]
            ],
            'durasi' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'durasi tidak boleh kosong!',
                    'integer' => 'durasi harus berupa angka!',
                ]
            ],

        ])) {
            return redirect()->to('/admin/edit_profil_jadwal/' . $id)->withInput();
        }

        $this->profil_jadwal->save([
            'id' => $id,
            'nama_profil' => $this->request->getVar('nama_profil'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
            'durasi' => $this->request->getVar('durasi'),
        ]);
        session()->setFlashdata('success', 'Perubahan berhasil disimpan!');
        return redirect()->to('/admin/profil_jadwal');
    }
    //--------------------------------------------------------------------

}
