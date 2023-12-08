<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'title' => 'Admin',
            ],
            [
                'title' => 'Member',
            ],
        ];

        foreach ($roles as $role) {
            $this->db->table('roles')->insert($role);
        }
    }
}
