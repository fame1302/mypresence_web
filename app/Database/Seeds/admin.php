<?php

namespace App\Database\Seeds;

class admin extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'id' => '',
            'username'    => 'fame1302',
            'password'    => '13131313',
            'email'    => 'fame1302@gmail.com',
            'level'    => '1'
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
