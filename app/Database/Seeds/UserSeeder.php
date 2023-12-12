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
                'name' => 'Ravalini',
                'username' => 'ravalini',
                'email' => 'ravalini@vigenesia.com',
                'password' => password_hash('19210823', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Raihan',
                'username' => 'rehan',
                'email' => 'rehan@vigenesia.com',
                'password' => password_hash('19210666', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Rista',
                'username' => 'rista',
                'email' => 'rista@vigenesia.com',
                'password' => password_hash('19210288', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Satria',
                'username' => 'bima',
                'email' => 'bima@vigenesia.com',
                'password' => password_hash('19210781', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Budiyanto',
                'username' => 'buduy',
                'email' => 'buduy@vigenesia.com',
                'password' => password_hash('19210448', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
            [
                'name' => 'Rizky',
                'username' => 'iki',
                'email' => 'iki@vigenesia.com',
                'password' => password_hash('19210588', PASSWORD_DEFAULT),
                'role_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}
