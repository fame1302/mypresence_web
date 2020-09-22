<?php

namespace App\Controllers;

use App\Libraries;
use App\Models\User;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;
use App\Models\JadwalModel;
use App\Models\LokasiModel;
use App\Models\ProfilJadwalModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;
use CodeIgniter\I18n\Time;
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
    protected $lokasi;
    protected $auth;

    public function __construct()
    {
        $this->karyawan = new KaryawanModel();
        $this->jabatan = new JabatanModel();
        $this->user = new UserModel();
        $this->profil_jadwal = new ProfilJadwalModel();
        $this->jadwal = new JadwalModel();
        $this->lokasi = new LokasiModel();

        (session()->user_data['level'] == 1) ? $this->auth = true : $this->auth = false;
    }

    public function index()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }
        if ($this->auth == false) {
            return redirect()->to(base_url() . '/');
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
            return redirect()->to(base_url() . '/login');
        }
        if (!$this->auth) {
            return redirect()->to(base_url() . '/');
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
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jabatan',
                'sub_title' => 'Tambah Jabatan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatan()
        ];

        return view('admin/tambah_jabatan', $data);

        # code...
    }

    function save_jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
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
            return redirect()->to(base_url() . '/admin/tambah_jabatan')->withInput();
        }

        $this->jabatan->save([
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'nama_singkat' => $this->request->getVar('nama_singkat'),
            'jml_karyawan' => $this->request->getVar('jml_karyawan')
        ]);
        session()->setFlashdata('success', 'Jabatan berhasil ditambahkan!');
        return redirect()->to(base_url() . '/admin/tambah_jabatan');
    }

    public function delete_jabatan($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $use = $this->karyawan->where(['id_jabatan' => $id])->first();
        if ($use !== null) {
            session()->setFlashdata('error', 'Jabatan sudah ada yang mengisi!');
            return redirect()->to(base_url() . '/admin/jabatan');
        }

        $this->jabatan->delete($id);
        session()->setFlashdata('success', 'Jabatan berhasil dihapus!');
        return redirect()->to(base_url() . '/admin/jabatan');
    }

    public function edit_jabatan($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jabatan',
                'sub_title' => 'Edit Jabatan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'jabatan' => $this->jabatan->where(['id' => $id])->first()
        ];

        return view('admin/edit_jabatan', $data);
    }

    public function update_jabatan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
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
            return redirect()->to(base_url() . '/admin/edit_jabatan/' . $id)->withInput();
        }

        $this->jabatan->save([
            'id' => $this->request->getVar('id'),
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
            'nama_singkat' => $this->request->getVar('nama_singkat'),
            'jml_karyawan' => $this->request->getVar('jml_karyawan')
        ]);
        session()->setFlashdata('success', 'Perubahan berhasil disimpan!');
        return redirect()->to(base_url() . '/admin/jabatan');
    }

    public function karyawan()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        // $jabatan = new JabatanModel();
        // $karyawan = new KaryawanModel();
        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Daftar Karyawan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'karyawan' => $this->karyawan->getKaryawan()
        ];

        return view('admin/karyawan', $data);
    }

    public function tambah_karyawan($alpha = false)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Tambah Karyawan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatan()
        ];

        return view('admin/tambah_karyawan', $data);
    }

    public function save_user()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
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
            return redirect()->to(base_url() . '/admin/tambah_karyawan')->withInput();
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
        return redirect()->to(base_url() . '/admin/tambah_karyawan');
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
        return redirect()->to(base_url() . '/admin/karyawan');
    }

    public function edit_user($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Karyawan',
                'sub_title' => 'Edit Karyawan',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'karyawan' => $this->karyawan->getKaryawanById($id),
            'validation' => \Config\Services::validation(),
            'list_jabatan' => $this->jabatan->getAvailableJabatanOnEdit($id)
        ];

        return view('admin/edit_karyawan', $data);
    }

    public function update_user()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
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
            return redirect()->to(base_url() . '/admin/edit_karyawan/' . $id_karyawan)->withInput();
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
        return redirect()->to(base_url() . '/admin/karyawan');
    }


    public function profil_jadwal()
    {
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Profil Jadwal',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

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
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'profil_jadwal' => $this->profil_jadwal->findAll()
        ];
        return view('admin/tambah_profil_jadwal', $data);
        # code...
    }

    public function save_profil_jadwal()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
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
            return redirect()->to(base_url() . '/admin/tambah_profil_jadwal')->withInput();
        }
        $def = ($this->request->getVar('default') == 'on') ? 1 : null;
        if ($def != null) {
            $this->profil_jadwal->clearDefault();
        }
        $this->profil_jadwal->save([
            'nama_profil' => $this->request->getVar('nama_profil'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
            'durasi' => $this->request->getVar('durasi'),
            'default' => $def
        ]);

        session()->setFlashdata('success', 'profil berhasil disimpan!');
        return redirect()->to(base_url() . '/admin/profil_jadwal');
    }

    public function delete_profil_jadwal($id)
    {

        $this->profil_jadwal->delete($id);

        session()->setFlashdata('success', 'Data berhasil di dihapus!');
        return redirect()->to(base_url() . '/admin/profil_jadwal');
    }

    public function edit_profil_jadwal($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Profil Jadwal',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'profil_jadwal' => $this->profil_jadwal->find($id)
        ];

        return view(base_url() . '/admin/edit_profil_jadwal', $data);
    }

    public function update_profil_jadwal()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }
        // dd($this->request->getVar());
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
            return redirect()->to(base_url() . '/admin/edit_profil_jadwal/' . $id)->withInput();
        }
        $def = ($this->request->getVar('default') == 'on') ? 1 : null;
        if ($def != null) {
            $this->profil_jadwal->clearDefault();
        }
        $this->profil_jadwal->save([
            'id' => $id,
            'nama_profil' => $this->request->getVar('nama_profil'),
            'jam_masuk' => $this->request->getVar('jam_masuk'),
            'jam_pulang' => $this->request->getVar('jam_pulang'),
            'durasi' => $this->request->getVar('durasi'),
            'default' => $def
        ]);
        session()->setFlashdata('success', 'Perubahan berhasil disimpan!');
        return redirect()->to(base_url() . '/admin/profil_jadwal');
    }

    public function lokasi()
    {
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Lokasi',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'lokasi' => $this->lokasi->findAll()
        ];
        return view('admin/lokasi', $data);
        # code...
    }

    public function add_lokasi()
    {
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Lokasi',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'lokasi' => $this->lokasi->findAll()
        ];
        return view('admin/tambah_lokasi', $data);
        # code...
    }

    public function save_lokasi()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }
        if (!$this->validate([
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama lokasi tidak boleh kosong!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'alamat tidak boleh kosong!',
                ]
            ],
            'lat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat tidak boleh kosong!',
                ]
            ],
            'long' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat tidak boleh kosong!',
                ]
            ],

        ])) {
            return redirect()->to(base_url() . '/admin/tambah_lokasi')->withInput();
        }
        $def = ($this->request->getVar('default') == 'on') ? 1 : null;
        if ($def != null) {
            $this->lokasi->clearDefault();
        }
        $this->lokasi->save([
            'nama_lokasi' => $this->request->getVar('nama_lokasi'),
            'alamat' => $this->request->getVar('alamat'),
            'lat' => $this->request->getVar('lat'),
            'long' => $this->request->getVar('long'),
            'default' => $def,
        ]);

        session()->setFlashdata('success', 'lokasi berhasil disimpan!');
        return redirect()->to(base_url() . '/admin/lokasi');
    }

    public function delete_lokasi($id)
    {

        $this->lokasi->delete($id);

        session()->setFlashdata('success', 'Data berhasil di dihapus!');
        return redirect()->to(base_url() . '/admin/lokasi');
    }

    public function edit_lokasi($id)
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }

        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Lokasi',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'validation' => \Config\Services::validation(),
            'lokasi' => $this->lokasi->find($id)
        ];

        return view(base_url() . '/admin/edit_lokasi', $data);
    }

    public function update_lokasi()
    {
        if (!isset(session()->user_data)) {
            return redirect()->to(base_url() . '/login');
        }
        $id = $this->request->getVar('id');
        if (!$this->validate([
            'nama_lokasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama lokasi tidak boleh kosong!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'alamat tidak boleh kosong!',
                ]
            ],
            'lat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat tidak boleh kosong!',
                ]
            ],
            'long' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'koordinat tidak boleh kosong!',
                ]
            ],

        ])) {
            return redirect()->to(base_url() . '/admin/edit_lokasi/' . $id)->withInput();
        }
        $def = ($this->request->getVar('default') == 'on') ? 1 : null;
        if ($def != null) {
            $this->lokasi->clearDefault();
        }
        $this->lokasi->save([
            'id' => $id,
            'nama_lokasi' => $this->request->getVar('nama_lokasi'),
            'alamat' => $this->request->getVar('alamat'),
            'lat' => $this->request->getVar('lat'),
            'long' => $this->request->getVar('long'),
            'default' => $def
        ]);

        session()->setFlashdata('success', 'lokasi berhasil diubah!');
        return redirect()->to(base_url() . '/admin/lokasi');
    }

    public function jadwal()
    {
        $bln = $this->request->getVar('bl');
        $thn = $this->request->getVar('th');
        $n = Time::now('Asia/Jakarta');
        $today = Time::create($n->getYear(), $n->getMonth(), $n->getDay(), null, null, null, 'Asia/Jakarta');

        //data bulan
        if ($bln != '' || $thn != '') {
            $now = Time::createFromDate($thn, $bln);
        } else {
            $now = Time::now();
        }

        // list bulan
        for ($i = 1; $i < 13; $i++) {
            $bln = Time::createFromDate('2020', $i);
            $bulan[] = $bln;
        }


        $last = cal_days_in_month(CAL_GREGORIAN, $now->getMonth(), $now->getYear());
        $tgl = array();
        for ($i = 1; $i < $last + 1; $i++) {
            $date = Time::createFromDate($now->getYear(), $now->getMonth(), $i)->toLocalizedString('Y-MM-dd');
            $jadwal = $this->jadwal->where(['tanggal' => $date])->first();
            $req = Time::create($now->getYear(), $now->getMonth(), $i);
            $tgl[] = [
                'index' => Time::createFromDate($now->getYear(), $now->getMonth(), $i)->toLocalizedString('e'),
                'tanggal' => $i,
                'hari' => Time::createFromDate($now->getYear(), $now->getMonth(), $i)->toLocalizedString('E'),
                'date' => $date,
                'jadwal' =>  [
                    'jam_masuk' => $this->profil_jadwal->where(['id' => $jadwal['id_profil']])->first()['jam_masuk'],
                    'jam_pulang' => $this->profil_jadwal->where(['id' => $jadwal['id_profil']])->first()['jam_pulang'],
                    'lokasi' => $this->lokasi->where(['id' => $jadwal['id_lokasi']])->first()['nama_lokasi'],
                    'able' => ($req->isBefore($today)) ? 'false' : 'true',
                ]
            ];
        };
        // dd($tgl);
        $data = [
            'page_data' => [
                'title' => 'Jadwal',
                'sub_title' => 'Manage Jadwal',
            ],
            'user' => $this->karyawan->getKaryawan(session()->user_data['username']),

            'jadwal' => $this->jadwal->findAll(),
            'bulan' => $bulan,
            'tgl' => $tgl,
            'now' => $now,
            'jml_hari' => $last
        ];
        // $da = cal_days_in_month(CAL_GREGORIAN, 01, 2020);
        // dd($now);
        return view('admin/jadwal', $data);
    }

    public function generate_jadwal()
    {
        $n = Time::now('Asia/Jakarta');
        $now = Time::create($n->getYear(), $n->getMonth(), $n->getDay(), null, null, null, 'Asia/Jakarta');
        // dd($this->request->getVar());
        // dd($now);
        $pdef = $this->profil_jadwal->where(['default' => 1])->first();
        $ldef = $this->lokasi->where(['default' => 1])->first();
        if ($pdef == null) {
            session()->setFlashdata('error', 'tidak ada profil default!');
            return redirect()->to($this->request->getVar('c_url'));
        } elseif ($ldef == null) {
            session()->setFlashdata('error', 'tidak ada lokasi default!');
            return redirect()->to($this->request->getVar('c_url'));
        };

        $test = array();
        for ($i = 1; $i <= $this->request->getVar('jml_hari'); $i++) {
            $req = Time::create($this->request->getVar('tahun'), $this->request->getVar('bulan'), $i, null, null, null, 'Asia/Jakarta');
            if ($req->isBefore($now)) {
                session()->setFlashdata('warning', 'tidak bisa menambahkan jadwal sebelum hari ini!');
            } else {
                session()->setFlashdata('success', 'generate jadwal berhasil!');
                $tgl = $req->toLocalizedString('Y-MM-dd');
                if ($this->jadwal->where(['tanggal' => $tgl])->first() == null) {
                    if ($req->toLocalizedString('e') == 1 || $req->toLocalizedString('e') == 7) {
                    } else {
                        $this->jadwal->save([
                            'id_profil' => $pdef['id'],
                            'tanggal' => $tgl,
                            'id_lokasi' => $ldef['id']
                        ]);
                    }
                }
            }
        }
        // dd($test);
        return redirect()->to($this->request->getVar('c_url'));
        # code...
    }

    public function add_jadwal()
    {
        $tgl = $this->request->getVar('tgl');
        $data = [
            'validation' => \Config\Services::validation(),
            'profil' => $this->profil_jadwal->findAll(),
            'lokasi' => $this->lokasi->findAll(),
            'jadwal' => $this->jadwal->where(['tanggal' => $tgl])->first(),
            'tanggal' => $tgl,
            'url' => $this->request->getVar('url')
        ];
        // dd($data['jadwal']);
        return view('admin/tambah_jadwal', $data);
    }

    public function save_jadwal()
    {
        $tgl = $this->request->getVar('tanggal');
        $jadwal = $this->jadwal->where(['tanggal' => $tgl])->first();
        if ($jadwal == null) {
            $this->jadwal->save([
                'id_profil' => $this->request->getVar('profil'),
                'tanggal' => $tgl,
                'id_lokasi' => $this->request->getVar('lokasi')
            ]);
        } else {
            $this->jadwal->save([
                'id' => $jadwal['id'],
                'id_profil' => $this->request->getVar('profil'),
                'tanggal' => $tgl,
                'id_lokasi' => $this->request->getVar('lokasi')
            ]);
        }
        session()->setFlashdata('success', 'jadwal berhasil ditambahkan!');
        return redirect()->to($this->request->getVar('url'));
    }

    public function delete_jadwal()
    {
        $tgl = $this->request->getVar('tgl');
        $id = $this->jadwal->where(['tanggal' => $tgl])->first()['id'];
        $this->jadwal->delete($id);
        session()->setFlashdata('success', 'jadwal berhasil dihapus');
        dd($id);
    }
}
