<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'title' => 'Motivasi',
            ],
            [
                'title' => 'Cerita',
            ],
            [
                'title' => 'Cita-cita',
            ],
        ];

        foreach ($categories as $category) {
            $this->db->table('categories')->insert($category);
        }
    }
}
