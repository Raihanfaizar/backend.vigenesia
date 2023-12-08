<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('UserSeeder');
        $this->call('CategorySeeder');
        $this->call('PostSeeder');
        $this->call('ReportSeeder');
    }
}