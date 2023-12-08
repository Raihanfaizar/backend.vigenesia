<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Vigenesia',
                'username' => 'vigenesia',
                'email' => 'admin@vigenesia.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'role_id' => 1,
            ],
            [
                'name' => 'Kelvin Riangga Putra',
                'username' => 'kelvin',
                'email' => 'kelvin@vigenesia.com',
                'password' => password_hash('19210817', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Gilang Putra Pratama',
                'username' => 'gilang',
                'email' => 'gilang@vigenesia.com',
                'password' => password_hash('19210365', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Ajeng Sasmoro Dewi',
                'username' => 'ajeng',
                'email' => 'ajeng@vigenesia.com',
                'password' => password_hash('19210570', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Eka Kurnia Febriyanti',
                'username' => 'eka',
                'email' => 'eka@vigenesia.com',
                'password' => password_hash('19210637', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Muhammad Rizky Khairullah',
                'username' => 'rizky',
                'email' => 'rizky@vigenesia.com',
                'password' => password_hash('19210317', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}
